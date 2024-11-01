<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DanhGia extends Model
{
    protected $table = 'danh_gia';
    protected $primaryKey = 'id';
    protected $fillable = ['muc_lon', 'muc_nho', 'noi_dung_danh_gia', 'diem_chuan'];

}
