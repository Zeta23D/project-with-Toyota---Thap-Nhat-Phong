<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\KhachHang;
use App\Models\User;
class HoaDonTichDiem extends Model
{
    protected $table = 'hoa_don_tich_diem';
    protected $primaryKey = 'id_hoadon';
    protected $fillable = ['bien_so_xe', 'so_tien_thanh_toan', 'diem_quy_doi', 'id_nhanvien'];

    // Quan hệ với bảng KhachHang
    public function khachHang()
    {
        return $this->belongsTo(KhachHang::class, 'bien_so_xe', 'bien_so_xe');
    }
    // Quan hệ với bảng NhanVien
    public function nhanVien()
    {
        return $this->belongsTo(User::class, 'id_nhanvien');
    }
}
