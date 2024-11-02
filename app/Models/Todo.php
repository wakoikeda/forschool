<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    // 一括代入を許可するフィールドを指定
    protected $fillable = [
        'title',
        'description',
        'from',
        'to',
    ];
}
