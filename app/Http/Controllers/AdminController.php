<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ThongBao;
use App\Models\User;
use App\Models\TichDiem;
use App\Models\KhachHang;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // Lấy dữ liệu thông báo
        $dataThongBao = ThongBao::latest()->get();

        // Đếm số lượng người dùng
        $soLuongNguoiDung = User::count() - 1;
        $soLuongKhachHang = KhachHang::count();
        $nhanVienTieuBieu = User::latest()->get()->where("start", 1);

        $topCustomers = TichDiem::with('khachHang') // Liên kết với model KhachHang
        ->orderByDesc('so_diem_hien_tai') // Sắp xếp theo số điểm từ cao xuống thấp
        ->take(5) // Lấy 5 bản ghi đầu tiên
        ->get();


        // Trả dữ liệu về view dashboard
        return view('admin.dashboard', compact('dataThongBao', 'soLuongNguoiDung', 'nhanVienTieuBieu' , 'topCustomers', 'soLuongKhachHang'));
    }

}
