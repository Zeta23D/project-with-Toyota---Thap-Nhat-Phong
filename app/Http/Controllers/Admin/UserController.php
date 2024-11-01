<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('usertype', function($row){
                    $usertypes = ['admin' => 'Admin', 'user' => 'User', 'nvTichDiem' => 'NV Tích Điểm', 'nvThongKe' => 'NV Thống Kê', 'nvKPI' => 'NV KPI', 'Khách Hàng' => 'Khách Hàng']; // Ví dụ vai trò
                    $select = '<select class="form-control usertype-select" data-id="'.$row->id.'">';
                    foreach ($usertypes as $key => $usertype) {
                        $selected = $row->usertype == $key ? 'selected' : '';
                        $select .= '<option value="'.$key.'" '.$selected.'>'.$usertype.'</option>';
                    }
                    $select .= '</select>';
                    return $select;
                })
                ->addColumn('start_user', function($row){
                    $start_users = ['1' => 'Đã xét', '0' => 'Không xét']; // Ví dụ vai trò
                    $select = '<select class="form-control start_user-select" data-id="'.$row->id.'">';
                    foreach ($start_users as $key => $start) {
                        $selected = $row->start == $key ? 'selected' : '';
                        $select .= '<option value="'.$key.'" '.$selected.'>'.$start.'</option>';
                    }
                    $select .= '</select>';
                    return $select;
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm rounded-circle editUser" style="display: inline-flex; align-items: center; justify-content: center; margin-right: 5px;"><i class="fas fa-edit"></i></a>';
                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm rounded-circle deleteUser" style="display: inline-flex; align-items: center; justify-content: center; margin-left: 5px;"><i class="fas fa-trash"></i></a>';
                    return '<div style="display: flex; justify-content: center;">' . $btn . '</div>';
                })
                ->rawColumns(['usertype', 'action', 'start_user'])
                ->make(true);
        }
        return view('admin.user.all-user');
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);

        User::updateOrCreate(
            ['id' => $request->id],
            ['name' => $request->name, 'email' => $request->email, 'address' => $request->address]
        );

        return response()->json([
            'success' => 'Dữ liệu đã được lưu thành công.',
            'errors' => $validatedData,
            'toastr' => true,
        ]);
    }

    public function edit($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return response()->json([
            'success' => 'Dữ liệu đã được xoá thành công.',
            'toastr' => true,
        ]);
    }


    public function changeRole(Request $request, $id)
    {
        $user = User::find($id);
        if ($user) {
            $user->usertype = $request->usertype;
            $user->save();
            return response()->json(['success' => 'Cập nhật quyền thành công.']);
        }
        return response()->json(['error' => 'Lỗi......'], 404);
    }

    public function changeStart(Request $request, $id)
    {
        $user = User::find($id);
        if ($user) {
            $user->start = $request->userstart;
            $user->save();
            return response()->json(['success' => 'Xét nhân viên tiêu biểu thành công!!!']);
        }
        return response()->json(['error' => 'Lỗi......'], 404);
    }


    public function getUsers()
    {
        $users = User::select('id', 'name')->get();
        return response()->json($users);
    }
}

