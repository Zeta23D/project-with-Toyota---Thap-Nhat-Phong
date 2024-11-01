<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KhachHang extends Model
{
    protected $table = 'khach_hang';
    protected $primaryKey = 'id';
    protected $fillable = ['ten_khach_hang','so_dien_thoai','bien_so_xe','so_vin', 'dia_chi', 'user_id'];
// Liên kết table user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
// Liên kết table tích điểm
    public function TichDiemKH()
    {
        return $this->hasOne(TichDiem::class, 'bien_so_xe');
    }
}
