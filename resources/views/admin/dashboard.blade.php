@extends('admin.master')
@section('title', 'Trang Chủ')

@section('main-content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Trang chủ</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">TOYOTA</a></li>
                    <li class="breadcrumb-item active">Trang chủ</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- SL Nhân Viên và Tích điểm KH sẽ nằm trong một hàng (row) -->
            <div class="col-md-6 col-12">
                {{-- SL Nhân Viên --}}
                <div class="row">
                    <div class="col-lg-12 col-6">
                        <div class="small-box" style="background-color: #5e95fb; text-align: center; color: white">
                            <div class="inner">
                                <h6>Số lượng nhân viên</h6>
                                <h3>{{ $soLuongNguoiDung }}</h3>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{ route('admin.users.index') }}" class="small-box-footer">Xem chi tiết <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-12 col-6">
                        <div class="small-box" style="background-color: #65c5e5; color: white; text-align: center">
                            <div class="inner">
                                <h6>Số lượng khách hàng</h6>
                                <h3>{{ $soLuongKhachHang }}</h3>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{ route('admin.khachhang.index') }}" class="small-box-footer">Xem chi tiết <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tích điểm KH -->
            <div class="col-md-6 col-12">
                <div class="col-lg-12">
                    <div class="small-box" style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 8px; padding: 20px;">
                        <div class="inner">
                            <h6 style="color: #000000; font-weight: bold; font-size: 18px; text-align: center;">
                                Top 5 Khách Hàng Tích Điểm Cao Nhất
                            </h6>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered" style="margin-top: 20px;">
                                    <thead style="background-color: #fdf98d;">
                                        <tr>
                                            <th style="text-align: center;">Tên Khách Hàng</th>
                                            <th style="text-align: center;">Biển Số Xe</th>
                                            <th style="text-align: center;">Số Điểm</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($topCustomers as $customer)
                                            <tr>
                                                <td style="text-align: center;">{{ $customer->khachHang->ten_khach_hang }}</td>
                                                <td style="text-align: center;">{{ $customer->khachHang->bien_so_xe }}</td>
                                                <td style="text-align: center; font-weight: bold; color: #28a745;">
                                                    {{ $customer->so_diem_hien_tai }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Thông Báo -->
            <div class="col-md-6 col-12">
                <div class="col-lg-12">
                    <div class="small-box bg-warning">
                        <div class="card card-warning">
                            <div class="card-header">
                                <h4 class="card-title">Thông báo</h4>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                            class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body" style="padding: 0.25rem">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered table-striped dataTable" style="margin-top: -6px !important">
                                        <tbody style="background-color: #007bff26">
                                            @foreach ($dataThongBao as $item)
                                            <tr data-url="{{ asset('/' . $item->file_path) }}">
                                                <td style="padding: .25rem">
                                                    <span class="text-black">
                                                        {{$item->title}}
                                                    </span>
                                                    <br>
                                                    <span class="text-sm text-info">
                                                        {{$item->content}}
                                                    </span>
                                                    <span class="right badge badge-warning" style="color: white">Nhấn vào để xem
                                                        chi tiết</span>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Nhân viên tiêu biểu -->
            <div class="col-md-6 col-12">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Nhân viên tiêu biểu</h3>
                            <div class="card-tools">
                                <span class="badge badge-danger">8 Nhân Viên</span>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <ul class="users-list clearfix row">
                                @foreach ($nhanVienTieuBieu as $itemNV)
                                    <li class="col-6 col-md-3 text-center">
                                        <img class="img-fluid rounded" style="width: 80px; height: 80px;" src="{{ $itemNV->avatar ? asset('uploads/photo/' . $itemNV->avatar) : asset('uploads/default/default.jpg') }}" alt="User Image">
                                        <a class="users-list-name" href="#">{{ $itemNV->name }}</a>
                                        <span class="users-list-date">Tháng 9</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')
<script type="text/javascript">
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
        $('table tbody').on('click', 'tr', function() {
            var url = $(this).data('url');
            if (url) {
                window.open(url, '_blank');
            }
        });
    });
</script>
@endsection
