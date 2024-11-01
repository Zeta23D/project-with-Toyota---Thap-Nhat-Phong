<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LichSuDoiQua extends Model
{
    protected $table = 'lich_su_doi_qua';
    protected $primaryKey = 'id_ls_quatang';
    protected $fillable = ['bien_so_xe', 'id_quatang', 'id_nhanvien'];

        // Quan hệ với bảng KhachHang
        public function khachHang()
        {
            return $this->belongsTo(KhachHang::class, 'bien_so_xe', 'bien_so_xe');
        }

        // Quan hệ với bảng NhanVien
        public function NhanVien()
        {
            return $this->belongsTo(User::class, 'id_nhanvien');
        }

        public function QuaTang()
        {
            return $this->belongsTo(QuaTang::class, 'id_quatang');
        }
}
