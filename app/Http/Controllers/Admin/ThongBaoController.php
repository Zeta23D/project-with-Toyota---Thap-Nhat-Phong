<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ThongBao;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;

class ThongBaoController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ThongBao::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('active', function($row){
                    $actives = [1 => 'Hoạt động', 0 => 'Không hoạt động'];
                    $select = '<select class="form-control active-select" data-id="'.$row->id.'">';
                    foreach ($actives as $key => $active) {
                        $selected = $row->active == $key ? 'selected' : '';
                        $select .= '<option value="'.$key.'" '.$selected.'>'.$active.'</option>';
                    }
                    $select .= '</select>';
                    return $select;
                })
                ->addColumn('action', function($row){
                    $editButton = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm rounded-circle editThongBao" style="display: inline-flex; align-items: center; justify-content: center; margin-right: 5px;"><i class="fas fa-edit"></i></a>';
                    $deleteButton = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm rounded-circle deleteThongBao" style="display: inline-flex; align-items: center; justify-content: center; margin-left: 5px;"><i class="fas fa-trash"></i></a>';
                    return '<div style="display: flex; justify-content: center;">' . $editButton . $deleteButton . '</div>';
                })
                ->rawColumns(['active', 'action'])
                ->make(true);
        }
        return view('admin.thongbao.thongbao');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $data = $request->only(['title', 'content']);
        if ($request->id && $request->hasFile('file_path')) {
            $thongBao = ThongBao::find($request->id);
            if ($thongBao && $thongBao->file_path) {
                @unlink(public_path($thongBao->file_path)); // Xóa file cũ
            }
        }
        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
                        . '_' . now()->format('YmdHis')
                        . '.' . $file->getClientOriginalExtension();
            $filePath = 'uploads/thongbao/' . $filename;
            $file->move(public_path('uploads/thongbao'), $filename); // Di chuyển file
            $data['file_path'] = $filePath; // Lưu đường dẫn vào database
        }
        ThongBao::updateOrCreate(['id' => $request->id], $data);
        return response()->json([
            'success' => 'Dữ liệu đã được lưu thành công.',
            'errors' => $validatedData,
            'toastr' => true,
        ]);
    }

    public function edit($id)
    {
        $thongBao = ThongBao::find($id);
        return response()->json($thongBao);
    }

    public function destroy($id)
    {
        $thongBao = ThongBao::findOrFail($id);
        if ($thongBao->file_path) {
            @unlink(public_path($thongBao->file_path)); // Xóa file đính kèm
        }
        $thongBao->delete();
        return response()->json([
            'success' => 'Dữ liệu đã được xoá thành công.',
            'toastr' => true,
        ]);
    }


    public function changeRole(Request $request, $id)
    {
        $thongBao = ThongBao::findOrFail($id);
        $thongBao->active = $request->active;
        $thongBao->save();
        return response()->json(['success' => 'Cập nhật quyền thành công.']);
    }
}

