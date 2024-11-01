<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kpis extends Model
{
    protected $primaryKey = 'id_kpi';
    protected $fillable = ['name', 'diem', 'thang', 'nam', 'ghi_chu'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_nhanvien');
    }
}
