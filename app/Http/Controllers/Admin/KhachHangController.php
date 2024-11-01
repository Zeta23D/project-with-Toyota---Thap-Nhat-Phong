<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KhachHang;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class KhachHangController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = KhachHang::with('user')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm rounded-circle editUser" style="display: inline-flex; align-items: center; justify-content: center; margin-right: 5px;"><i class="fas fa-edit"></i></a>';
                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm rounded-circle deleteUser" style="display: inline-flex; align-items: center; justify-content: center; margin-left: 5px;"><i class="fas fa-trash"></i></a>';
                    return '<div style="display: flex; justify-content: center;">' . $btn . '</div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.khachhang.index');
    }

    public function store(Request $request)
    {
        // $data = $request->all();
        // echo "<pre>"; print_r($data); die;
        $user_id = $request->user_id;
        $validatedData = $request->validate([
            'ten_khach_hang' => 'required',
            'so_dien_thoai' => 'required',
            'dia_chi' => 'nullable',
            'bien_so_xe' => 'required',
            'so_vin' => 'required',
        ]);

        $khachHang = KhachHang::updateOrCreate(
            ['id' => $request->id], // Điều kiện tìm kiếm (user_id)
            [
                'ten_khach_hang' => $validatedData['ten_khach_hang'],
                'so_dien_thoai' => $validatedData['so_dien_thoai'],
                'dia_chi' => $validatedData['dia_chi'],
                'bien_so_xe' => $validatedData['bien_so_xe'],
                'so_vin' => $validatedData['so_vin'],
                // 'user_id' =>  $user->id,
            ]
        );

        return response()->json([
            'success' => 'Dữ liệu đã được lưu thành công.',
            'errors' => $validatedData,
            'toasts' => true,
        ]);
    }



    public function edit($id)
    {
        $khachHang = KhachHang::with('user')->find($id);
        return response()->json($khachHang);
    }


    public function destroy($id)
    {
        $khachHang = KhachHang::find($id);
        $user = User::find($khachHang->user_id);

        if ($user) {
            $user->delete();
        }

        $khachHang->delete();

        return response()->json([
            'success' => 'Dữ liệu đã được xoá thành công.',
            'toastr' => true,
        ]);
    }
}
