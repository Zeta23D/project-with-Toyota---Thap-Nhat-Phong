<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuaTang;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class QuaDoiController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = QuaTang::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id_quatang.'" data-original-title="Edit" class="edit btn btn-primary btn-sm rounded-circle editQuaTang" style="display: inline-flex; align-items: center; justify-content: center; margin-right: 5px;"><i class="fas fa-edit"></i></a>';
                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id_quatang.'" data-original-title="Delete" class="btn btn-danger btn-sm rounded-circle deleteQuaTang" style="display: inline-flex; align-items: center; justify-content: center; margin-left: 5px;"><i class="fas fa-trash"></i></a>';
                    return '<div style="display: flex; justify-content: center;">' . $btn . '</div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.quatang.index');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'ten_qua_tang' => 'required',
            'so_diem_duoc_doi' => 'required',
        ]);

        QuaTang::updateOrCreate(
            ['id_quatang' => $request->id],
            [
                'ten_qua_tang' => $request->ten_qua_tang,
                'so_diem_duoc_doi' => $request->so_diem_duoc_doi,
                'ghi_chu' => $request->ghi_chu
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
        $quaTang = QuaTang::find($id);
        return response()->json($quaTang);
    }


    public function destroy($id)
    {
        QuaTang::find($id)->delete();
        return response()->json([
            'success' => 'Dữ liệu đã được xoá thành công.',
            'toastr' => true,
        ]);
    }
}
