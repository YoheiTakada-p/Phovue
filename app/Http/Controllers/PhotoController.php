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
        $this->middleware('auth');
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
            Auth::user()->photos()->save($photo);
            DB::commit();
        } catch (\Exception $exception) {
            \DB::rollback();
            \Storage::cloud()->delete($photo->filename);
            throw $exception;
        }

        return response($photo, 201);
    }
}
