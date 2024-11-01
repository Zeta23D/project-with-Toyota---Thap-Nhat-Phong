<?php

use App\Http\Controllers\Admin\KPIController;
use App\Http\Controllers\Admin\DanhGiaKPIController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ThongBaoController;
use App\Http\Controllers\Admin\KhachHangController;
use App\Http\Controllers\Admin\TichDiemKhachHangController;
use App\Http\Controllers\Admin\QuaDoiController;
use App\Http\Controllers\Admin\ThongKeVaDoiQuaController;
use App\Http\Controllers\Admin\ThongKeDiemController;

use Illuminate\Support\Facades\Route;

    Route::get('/', function () {
        return view('dashboard');
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

require __DIR__.'/auth.php';

// Cấu hình URL ADMIN
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function() {
    route::get("dashboard",[AdminController::class, 'index'])->name("admin.dashboard");
    Route::resource('users', UserController::class)->names("admin.users");
    route::get("profile",[ProfileController::class, 'index'])->name("admin.profile");
    Route::put('profile/update', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::post('/admin/users/{id}/change-role', [UserController::class, 'changeRole'])->name('admin.users.changeRole');
    Route::post('/admin/users/{id}/change-start', [UserController::class, 'changeStart'])->name('admin.users.changeStart');

    //Thông báo
    Route::resource('thongbao', ThongBaoController::class)->names("admin.thongbao");

    Route::post('/admin/thongbao/{id}/change-role', [ThongBaoController::class, 'changeRole'])->name('admin.thongbao.changeRole');

    //KPI
    Route::resource('kpis', KPIController::class)->names("admin.kpi");

    Route::post('/admin/kpis/import', [KPIController::class, 'import'])->name('kpis.import');

    Route::resource('kpitieuchi', DanhGiaKPIController::class)->names("admin.kpi_tieuchi");

    //get all user
    Route::get('/users_api', [KPIController::class, 'getUsers'])->name('users.get');

    //get all user
    Route::get('/khachhang_api', [TichDiemKhachHangController::class, 'getKhachHang'])->name('khachhang.get');

    //Profile
    Route::post('/profile/update-avatar', [ProfileController::class, 'updateAvatar'])->name('profile.updateAvatar');

    //QL khách hàng
    Route::resource('khachhang', KhachHangController::class)->names("admin.khachhang");

    //QL hóa đơn tích điểm
    Route::resource('tichdiemkhachhang', TichDiemKhachHangController::class)->names("admin.tichdiemkhachhang");
    Route::resource('toyota-quatang', QuaDoiController::class)->names("admin.qua_doi");
    Route::resource('toyota-doiqua', ThongKeVaDoiQuaController::class)->names("admin.thongkevadoiqua");
    Route::resource('toyota-thongkediem', ThongKeDiemController::class)->names("admin.thongkediem");


});
