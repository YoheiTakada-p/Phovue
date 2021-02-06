<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//add
use App\Http\Requests\StorePhoto;
use App\Photo;
use App\Comment;

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

        $comment = new Comment(['comment' => $request->comment]);

        $photo->filename = $photo->id . '.' . $extension;

        //s3にファイルを保存する
        \Storage::cloud()
            ->putFileAs('', $request->photo, $photo->filename, 'public');

        //トランザクションの利用
        \DB::beginTransaction();

        try {
            \Auth::user()->photos()->save($photo);
            $photo->comment()->save($comment);
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
        $photos = Photo::with(['owner', 'likes', 'comment'])->orderBy('created_at', 'desc')->get();

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

        return response(200);
    }

    public function unlike(String $id)
    {
        $photo = Photo::find($id);

        $photo->likes()->detach(\Auth::user()->id);

        return response(200);
    }
}
