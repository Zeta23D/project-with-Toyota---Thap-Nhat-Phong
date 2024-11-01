<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThongBao extends Model
{
    protected $fillable = ['title', 'content', 'date_published', 'file_path', 'active'];
}
