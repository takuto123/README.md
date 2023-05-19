<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jyokyou extends Model
{
     //テーブル名
     protected $table = 'jyoukyou';

     // 可変項目
     protected $fillable=
     [
        'id',
         'jyoukyou',
         'created_at',
         'updated_at'
     ];
}
