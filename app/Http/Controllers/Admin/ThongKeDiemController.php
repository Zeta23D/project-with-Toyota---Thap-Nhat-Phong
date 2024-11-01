<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TichDiem;
use App\Models\LichSuDoiQua;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ThongKeDiemController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Lấy các tham số lọc từ yêu cầu
            $minScore = $request->get('minScore'); // Điểm tối thiểu
            $maxScore = $request->get('maxScore'); // Điểm tối đa

            // Lấy dữ liệu
            $query = TichDiem::with('KhachHang', 'NhanVien', 'QuaTang')->latest();

            // Kiểm tra nếu có yêu cầu lọc
            if ($minScore !== null || $maxScore !== null) {
                // Nếu có yêu cầu lọc, thêm điều kiện vào truy vấn
                $query->whereHas('KhachHang', function ($query) use ($minScore, $maxScore) {
                    if ($minScore !== null) {
                        $query->where('so_diem_hien_tai', '>=', $minScore);
                    }
                    if ($maxScore !== null) {
                        $query->where('so_diem_hien_tai', '<=', $maxScore);
                    }
                });
            }

            $data = $query->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('ten_khach_hang', function($row) {
                    return $row->khachHang ? $row->khachHang->ten_khach_hang : 'Không có';
                })
                ->addColumn('bien_so_xe', function($row) {
                    return $row->khachHang ? $row->khachHang->bien_so_xe : 'Không có';
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->bien_so_xe.'" data-original-title="Edit" class="edit btn btn-primary btn-sm rounded-circle EditLichSu" style="display: inline-flex; align-items: center; justify-content: center; margin-right: 5px;"><i class="fas fa-eye"></i></a>';
                    return '<div style="display: flex; justify-content: center;">' . $btn . '</div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.ThongKeDiem.index');
    }


    public function edit($bien_so_xe)
    {
        // Tìm kiếm tất cả bản ghi trong LichSuDoiQua với id_khach_hang
        $LichSuDoiQua = LichSuDoiQua::with(['khachHang', 'quaTang'])
                                      ->where('bien_so_xe', $bien_so_xe)
                                      ->get(); // Sử dụng get() để lấy nhiều bản ghi
        return response()->json($LichSuDoiQua);
    }

}
