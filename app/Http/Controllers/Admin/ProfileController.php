<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    public function index(){
        // Lấy thông tin người dùng hiện tại
        $user = Auth::user();
        // Lấy thông tin điểm KPI của người dùng có tháng lớn nhất
        $latestKpi = DB::table('kpis')
            ->where('name', $user->name)
            ->orderBy('thang', 'desc')
            ->first();
        // Lấy tất cả điểm KPI của một nhân viên cụ thể
        $userKpis = DB::table('kpis')
        ->where('name', $user->name)
        ->pluck('diem'); //
        $averageKpi = $userKpis->avg(); // Trung bình KPI

        $kpi_note = DB::table('kpis')
        ->where('name', $user->name)
        ->orderBy('thang', 'desc')
        ->get();

        // Trả dữ liệu về view profile
        return view('admin.profile.profile', compact('user', 'latestKpi', 'averageKpi', 'kpi_note'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
        ]);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->save();
        return response()->json([
            'message' => 'Thông tin của bạn đã được cập nhật thành công.',
            'toastr' => true,
        ]);
    }


// ProfileController.php
    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        $defaultAvatar = 'img-default.png'; // Tên file ảnh đại diện mặc định

        // Xóa ảnh cũ nếu tồn tại và không phải là ảnh mặc định
        if ($user->avatar && $user->avatar != $defaultAvatar) {
            $oldAvatarPath = public_path('uploads/photo/') . $user->avatar;
            if (file_exists($oldAvatarPath)) {
                unlink($oldAvatarPath);
            }
        }

        // Lưu ảnh mới
        $avatarName = $user->id . '_avatar' . time() . '.' . $request->avatar->getClientOriginalExtension();
        $request->avatar->move(public_path('uploads/photo'), $avatarName);
        $user->avatar = $avatarName;
        $user->save();

        return response()->json(['success' => 'Avatar updated successfully']);
    }



}
