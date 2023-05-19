<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zaiko extends Model
{
    // テーブル名
    protected $table = 'zaikos';

    // 可変項目
    protected $fillable = [
        'name',
        'kazu',
        'kakaku',
        'shosai',
        'jyoukyou',
    ];
}
