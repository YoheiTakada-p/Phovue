<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //ホワイトリスト
    protected $fillable = [
        'comment',
    ];
}
