<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'url', 
        'username',
        'password',
        'order_column',
    ];
    public static function ordered()
    {
        return self::orderBy('order_column')->get();
    }
}
