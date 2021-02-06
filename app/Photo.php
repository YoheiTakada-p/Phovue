<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //IDが自動増分しない
    public $incrementing = false;

    //プライマリキーの型
    protected $keyType = 'string';

    //取得したJSONに追加する
    protected $appends = [
        'url', 'like_count', 'liked_by_user'
    ];

    //JSONに含める属性
    protected $visible = [
        'id', 'url', 'owner', 'like_count', 'liked_by_user'
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        if (!\Arr::get($this->attributes, 'id')) {
            $this->setId();
        }
    }

    /**
     * ランダムIDを生成して代入する
     */
    public function setId()
    {
        $this->attributes['id'] = $this->getRandomId();
    }

    /**
     * ランダムIDを生成する関数
     */
    public function getRandomId()
    {
        return \Str::random(12);
    }

    /**
     * アクセサ - url
     */
    public function getUrlAttribute()
    {
        return \Storage::cloud()->url($this->attributes['filename']);
    }

    /**
     * アクセサ - like_count
     */
    public function getLikeCountAttribute()
    {
        return $this->likes->count();
    }

    /**
     * アクセサ - liked_by_user
     */
    public function getLikedByUserAttribute()
    {
        if ($this->likes->contains(\Auth::id())) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * リレーションシップ - users
     */
    public function owner()
    {
        //リレーションのメソッド名を任意に設定する場合、サフィックスは機能しない
        return $this->belongsTo('App\User', 'user_id', 'id', 'users');
    }

    /**
     * リレーションシップ - likes 中間テーブル
     */
    public function likes()
    {
        //第二引数は結合テーブル名のオーバーライド
        return $this->belongsToMany('App\User', 'likes');
    }

    /**
     * リレーションシップ - comments
     */
    public function comments()
    {
        return $this->hasMany('App\Comments');
    }
}
