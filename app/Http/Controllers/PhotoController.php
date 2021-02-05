<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//add
use App\Http\Requests\StorePhoto;
use App\Photo;

class PhotoController extends Controller
{
    public function __construct()
    {
        //認証が必要
        $this->middleware('auth')->except(['get', 'download']);
    }

    public function post(StorePhoto $request)
    {
        $extension = $request->photo->extension();

        $photo = new Photo();

        $photo->filename = $photo->id . '.' . $extension;

        //s3にファイルを保存する
        \Storage::cloud()
            ->putFileAs('', $request->photo, $photo->filename, 'public');

        //トランザクションの利用
        \DB::beginTransaction();

        try {
            \Auth::user()->photos()->save($photo);
            \DB::commit();
        } catch (\Exception $exception) {
            \DB::rollback();
            \Storage::cloud()->delete($photo->filename);
            throw $exception;
        }

        return response($photo, 201);
    }

    public function get()
    {
        $photos = Photo::with(['owner'])->orderBy('created_at', 'desc')->get();

        return $photos;
    }

    public function download(Photo $photo)
    {
        // 写真の存在チェック
        if (!\Storage::cloud()->exists($photo->filename)) {
            abort(404);
        }

        //ファイル名
        $name = $photo->filename;

        return \Storage::cloud()->download($photo->filename, $name);
    }

    public function like(String $id)
    {
        $photo = Photo::find($id);

        $photo->likes()->detach(\Auth::id());
        $photo->likes()->attach(\Auth::id());

        \Log::debug(Photo::where('id', $id)->with(['likes'])->first());
        // \Log::debug($photo->likes->contains(\Auth::id()));
        // \Log::debug(Photo::where('id', $id)->with(['likes'])->first());

        return response(200);
    }

    public function unlike(String $id)
    {
        $photo = Photo::find($id);

        $photo->likes()->detach(\Auth::user()->id);

        \Log::debug(Photo::where('id', $id)->with(['likes'])->first());

        return response(200);
    }
}
