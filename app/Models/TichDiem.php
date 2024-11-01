<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TichDiem extends Model
{
    protected $table = 'tich_diem_khach_hang';
    protected $primaryKey = 'id_tich_diem';
    protected $fillable = ['bien_so_xe', 'so_diem_tich_duoc', 'so_diem_hien_tai', 'ghi_chu', 'id_hoadon_tichdiem'];

    public function khachHang()
    {
        return $this->belongsTo(KhachHang::class, 'bien_so_xe', 'bien_so_xe');
    }

    public function NhanVien()
    {
        return $this->belongsTo(User::class, 'id_nhanvien');
    }

    public function QuaTang()
    {
        return $this->belongsTo(QuaTang::class, 'id_quatang');
    }


}
