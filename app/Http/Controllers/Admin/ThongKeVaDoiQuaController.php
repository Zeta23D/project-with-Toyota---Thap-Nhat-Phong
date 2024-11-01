<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuaTang;
use App\Models\TichDiem;
use App\Models\LichSuDoiQua;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ThongKeVaDoiQuaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = LichSuDoiQua::with('KhachHang', 'NhanVien', 'QuaTang')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('ten_khach_hang', function($row) {
                    return $row->khachHang ? $row->khachHang->ten_khach_hang : 'Không có';
                })
                ->addColumn('bien_so_xe', function($row) {
                    return $row->khachHang ? $row->khachHang->bien_so_xe : 'Không có';
                })
                ->addColumn('ten_nhan_vien', function($row) {
                    // Hiển thị tên nhân viên
                    return $row->nhanVien ? $row->nhanVien->name : 'Không có';
                })
                ->addColumn('qua_tang', function($row) {
                    // Hiển thị tên nhân viên
                    return $row->QuaTang ? $row->QuaTang->ten_qua_tang : 'Không có';
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id_ls_quatang.'" data-original-title="Edit" class="edit btn btn-primary btn-sm rounded-circle EditLichSu" style="display: inline-flex; align-items: center; justify-content: center; margin-right: 5px;"><i class="fas fa-edit"></i></a>';
                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id_ls_quatang.'" data-original-title="Delete" class="btn btn-danger btn-sm rounded-circle DeleteLichSu" style="display: inline-flex; align-items: center; justify-content: center; margin-left: 5px;"><i class="fas fa-trash"></i></a>';
                    return '<div style="display: flex; justify-content: center;">' . $btn . '</div>';
                })
                ->rawColumns(['tich_diem', 'action'])
                ->make(true);
        }

        $data_QuaTang = DB::table('qua_tang')->get();
        return view('admin.ThongKeVaDoiQua.index', compact('data_QuaTang'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'bien_so_xe' => 'required',
            'id_quatang' => 'required',
        ]);

        // Tìm bản ghi lịch sử đổi quà hiện tại nếu có
        $lichSuDoiQua = LichSuDoiQua::find($request->id_lichsu_doiqua);

        // Lấy hoặc tạo bản ghi Tích điểm cho khách hàng
        $tichDiem = TichDiem::firstOrNew(['bien_so_xe' => $request->bien_so_xe]);

        // Nếu có bản ghi cũ, cộng lại số điểm của món quà cũ cho khách hàng
        if ($lichSuDoiQua) {
            $quaTangCu = QuaTang::find($lichSuDoiQua->id_quatang);
            if ($quaTangCu) {
                $tichDiem->so_diem_hien_tai += $quaTangCu->so_diem_duoc_doi;  // Cộng lại số điểm của quà tặng cũ
            }
        }

        // Giảm điểm hiện tại của khách hàng bằng số điểm đổi quà mới
        $quaTangMoi = QuaTang::find($request->id_quatang);
        if ($quaTangMoi) {
            if ($tichDiem->so_diem_hien_tai >= $quaTangMoi->so_diem_duoc_doi) {
                $tichDiem->so_diem_hien_tai -= $quaTangMoi->so_diem_duoc_doi;
            } else {
                return response()->json([
                    'errors' => 'Số điểm hiện tại không đủ để đổi quà.',
                ], 400);
            }
        }

        // Cập nhật hoặc tạo mới lịch sử đổi quà
        LichSuDoiQua::updateOrCreate(
            ['id_ls_quatang' => $request->id_lichsu_doiqua],
            [
                'bien_so_xe' => $request->bien_so_xe,
                'id_quatang' => $request->id_quatang,
                'id_nhanvien' => $request->id_nhanvien,
                'ghi_chu' => $request->ghi_chu
            ]
        );

        // Cập nhật ghi chú nếu có
        if ($request->ghi_chu) {
            $tichDiem->ghi_chu = $request->ghi_chu;
        }

        // Lưu thông tin tích điểm
        $tichDiem->save();

        return response()->json([
            'success' => 'Dữ liệu đã được lưu thành công.',
            'toasts' => true,
            'errors' => $validatedData,
        ]);
    }



    public function edit($id)
    {
        $LichSuDoiQua = LichSuDoiQua::with(['khachHang', 'quaTang'])->find($id);
        return response()->json($LichSuDoiQua);
    }



    public function destroy($id)
    {
        // Tìm bản ghi lịch sử đổi quà theo id
        $lichSuDoiQua = LichSuDoiQua::find($id);

        if ($lichSuDoiQua) {
            // Tìm khách hàng và quà tặng liên quan
            $tichDiem = TichDiem::where('bien_so_xe', $lichSuDoiQua->bien_so_xe)->first();
            $quaTang = QuaTang::find($lichSuDoiQua->id_quatang);

            // Nếu tìm thấy cả khách hàng và quà tặng
            if ($tichDiem && $quaTang) {
                // Cộng lại điểm của món quà vào điểm hiện tại của khách hàng
                $tichDiem->so_diem_hien_tai += $quaTang->so_diem_duoc_doi;
                $tichDiem->save();  // Lưu lại thay đổi
            }

            // Xóa bản ghi lịch sử đổi quà
            $lichSuDoiQua->delete();

            return response()->json([
                'success' => 'Dữ liệu đã được xoá thành công và điểm đã được cộng lại.',
                'toasts' => true,
            ]);
        }

        return response()->json([
            'error' => 'Không tìm thấy bản ghi cần xoá.',
            'toasts' => true,
        ], 404);
    }

}
