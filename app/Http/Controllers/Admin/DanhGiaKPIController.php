<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DanhGia;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DanhGiaKPIController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DanhGia::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm rounded-circle editUser"><i class="fas fa-edit"></i></a>';
                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm rounded-circle deleteUser"><i class="fas fa-trash"></i></a>';
                    return '<div class="text-center">' . $btn . '</div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.kpi_tieuchi.kpi_tieuchi');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'muc_lon' => 'nullable|string',
            'muc_nho' => 'nullable|string',
            'noi_dung_danh_gia' => 'required|string',
            'diem_chuan' => 'nullable|numeric',
        ]);

        DanhGia::updateOrCreate(
            ['id' => $request->id],
            $validatedData
        );

        return response()->json([
            'success' => 'Dữ liệu đã được lưu thành công.',
            'toastr' => true,
        ]);
    }

    public function edit($id)
    {
        $kpi = DanhGia::find($id);
        return response()->json($kpi);
    }

    public function destroy($id)
    {
        DanhGia::find($id)->delete();
        return response()->json([
            'success' => 'Dữ liệu đã được xoá thành công.',
            'toastr' => true,
        ]);
    }
}
