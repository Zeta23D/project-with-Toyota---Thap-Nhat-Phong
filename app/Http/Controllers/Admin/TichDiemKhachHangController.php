<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KhachHang;
use App\Models\HoaDonTichDiem;
use App\Models\TichDiem;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TichDiemKhachHangController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = HoaDonTichDiem::with(['khachHang', 'nhanVien'])->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('khach_hang', function ($row) {
                    return $row->khachHang ? $row->khachHang->ten_khach_hang : 'Không có';
                })
                ->addColumn('bien_so_xe', function ($row) {
                    return $row->khachHang ? $row->khachHang->bien_so_xe : 'Không có';
                })
                ->addColumn('nhan_vien', function ($row) {
                    return $row->nhanVien ? $row->nhanVien->name : 'Không có';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id_hoadon . '" data-original-title="Edit" class="edit btn btn-primary btn-sm rounded-circle editHoaDon" style="display: inline-flex; align-items: center; justify-content: center; margin-right: 5px;"><i class="fas fa-edit"></i></a>';
                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-id="' . $row->id_hoadon . '" data-original-title="Delete" class="btn btn-danger btn-sm rounded-circle deleteHoaDon" style="display: inline-flex; align-items: center; justify-content: center; margin-left: 5px;"><i class="fas fa-trash"></i></a>';
                    return '<div style="display: flex; justify-content: center;">' . $btn . '</div>';
                })
                ->rawColumns(['action', 'khach_hang', 'bien_so_xe', 'nhan_vien'])
                ->make(true);
        }
        return view('admin.thanhtoan.index');
    }

    public function getKhachHang(Request $request)
    {
        $term = $request->get('term');

        // Tìm kiếm khách hàng theo SỐ VIN, chỉ lấy id và tên khách hàng
        $users = KhachHang::where('bien_so_xe', 'LIKE', '%' . $term . '%')
            ->get(['id', 'bien_so_xe', 'ten_khach_hang']);

        // Định dạng lại dữ liệu trả về cho jQuery UI Autocomplete
        $data = [];
        foreach ($users as $user) {
            $data[] = [
                'id' => $user->id, // id khách hàng
                'value' => $user->bien_so_xe, // Số VIN
                'ten_khach_hang' => $user->ten_khach_hang, // Số VIN
            ];
        }

        return response()->json($data);
    }


    public function store(Request $request)
    {
        $request->validate([
            'bien_so_xe' => 'required',
            'so_tien_thanh_toan' => 'required',
        ]);

        // Tìm hoặc tạo mới bản ghi TichDiem dựa trên id_khach_hang
        $tichDiem = TichDiem::firstOrNew(['bien_so_xe' => $request->bien_so_xe]);

        // Tính điểm mới dựa trên số tiền thanh toán
        // Giả sử bạn nhận giá trị từ input
        $soTienThanhToan = str_replace(',', '', $_POST['so_tien_thanh_toan']); // Loại bỏ dấu phẩy
        $soTienThanhToan = (int)$soTienThanhToan; // Chuyển đổi sang số nguyên

        // Tính điểm
        $diemMoi = $soTienThanhToan / 100000;


        // Mặc định số điểm thay đổi bằng điểm mới (nếu thêm mới)
        $diemThayDoi = $diemMoi;

        if ($request->isMethod('post') && $hoaDonTichDiem = HoaDonTichDiem::where('id_hoadon', $request->id)->first()) {
            // Tính sự thay đổi điểm dựa trên điểm cũ
            $diemThayDoi = $diemMoi - (float)$hoaDonTichDiem->diem_quy_doi; // Đảm bảo là số thực
        }

        // Cập nhật điểm tích được và điểm hiện tại
        $tichDiem->so_diem_tich_duoc += $diemThayDoi;
        $tichDiem->so_diem_hien_tai += $diemThayDoi;

        // Cập nhật ghi chú nếu có
        $tichDiem->ghi_chu = $request->ghi_chu;
        $tichDiem->save();

        // Lấy id_tichdiem sau khi lưu
        $idTichDiem = $tichDiem->id;

        // Thêm hoặc cập nhật vào bảng HoaDonTichDiem
        HoaDonTichDiem::updateOrCreate(
            ['id_hoadon' => $request->id],
            [
                'bien_so_xe' => $request->bien_so_xe,
                'so_tien_thanh_toan' => $soTienThanhToan, // Sử dụng giá trị đã chuyển đổi
                'diem_quy_doi' => $diemMoi,
                'id_nhanvien' => $request->id_nhanvien,
                'id_tichdiem_khachhang' => $idTichDiem,
            ]
        );

        return response()->json(['success' => 'Thao tác thành công!', 'toasts' => true]);
    }





    public function edit($id)
    {
        $hoaDonTichDiem = HoaDonTichDiem::with(['khachHang', 'nhanVien'])->find($id);
        return response()->json($hoaDonTichDiem);
    }


    public function destroy($id)
    {
        // Tìm hóa đơn dựa trên id
        $hoaDonTichDiem = HoaDonTichDiem::find($id);

        if (!$hoaDonTichDiem) {
            return response()->json([
                'error' => 'Hóa đơn không tồn tại.',
                'toasts' => true,
            ], 404);
        }

        // Tìm bản ghi tích điểm của khách hàng dựa trên id_khach_hang
        $tichDiem = TichDiem::where('bien_so_xe', $hoaDonTichDiem->bien_so_xe)->first();

        if ($tichDiem) {
            // Tính số điểm cần trừ dựa trên điểm quy đổi của hóa đơn
            $diemTru = $hoaDonTichDiem->diem_quy_doi;

            // Trừ điểm tích được và điểm hiện tại
            $tichDiem->so_diem_tich_duoc -= $diemTru;
            $tichDiem->so_diem_hien_tai -= $diemTru;

            // Lưu lại thông tin tích điểm sau khi cập nhật
            $tichDiem->save();
        }

        // Xóa hóa đơn sau khi cập nhật điểm
        $hoaDonTichDiem->delete();

        return response()->json([
            'success' => 'Hóa đơn và điểm đã được xoá thành công.',
            'toasts' => true,
        ]);
    }
}
