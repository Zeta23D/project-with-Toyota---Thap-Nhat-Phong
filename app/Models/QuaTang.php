<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuaTang extends Model
{
    protected $table = 'qua_tang';
    protected $primaryKey = 'id_quatang';
    protected $fillable = ['ten_qua_tang', 'so_diem_duoc_doi','ghi_chu'];
}
