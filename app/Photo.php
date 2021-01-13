<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //プライマリキーの型
    protected $keyType = 'string';

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
}
