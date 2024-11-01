@extends('admin.master')
@section('title', 'Thống kê tích điểm')

@section('main-content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{-- <h1 class="m-0">Nhân viên</h1> --}}
                    {{-- <button class="btn btn-success" id="DoiQuaTang">Đổi quà</button> --}}
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">TOYOTA</a></li>
                        <li class="breadcrumb-item active">Thống kê và đổi quà tặng</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header" style="text-align: center">

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="number" id="minScore" class="form-control" placeholder="Điểm tối thiểu" aria-label="Điểm tối thiểu">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Điểm</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="number" id="maxScore" class="form-control" placeholder="Điểm tối đa" aria-label="Điểm tối đa">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Điểm</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <button id="filterBtn" class="btn btn-primary btn-block">Lọc</button>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped dataTable">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên khách hàng</th>
                                            <th>Biển số xe</th>
                                            <th>Số điểm tích được</th>
                                            <th>Số điểm hiện tại</th>
                                            <th width="150px" style="text-align: center">Xem lịch sử</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Modal ADD --}}
    <div class="modal fade" id="QuaTangModel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading">Lịch Sử Đổi Quà Tặng Khách Hàng</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Phần thống kê -->
                    <div id="thongKeSection">
                        <h5>Thống kê quà tặng</h5>
                        <p>Tổng số quà tặng đã được tặng: <span id="tong_qua_tang">0</span></p>
                        <p>Thống kê chi tiết:</p>
                    </div>

                    <!-- Bảng lịch sử quà tặng -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Ngày Đổi</th>
                                <th>Tên Khách Hàng</th>
                                <th>Tên Quà Tặng</th>
                                <th>Số Điểm Đổi Quà</th>
                                <th>Ghi Chú</th>
                            </tr>
                        </thead>
                        <tbody id="lichSuDoiQuaBody">
                            <tr>
                                <td colspan="5" class="text-center">Không có dữ liệu</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section("script")
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {
        // Cấu hình Toastr
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "5000",
        };

        var table = $('.dataTable').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            ajax: {
                url: "{{ route('admin.thongkediem.index') }}",
                data: function (d) {
                    d.minScore = $('#minScore').val();
                    d.maxScore = $('#maxScore').val();
                }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'ten_khach_hang', name: 'ten_khach_hang'},
                {data: 'bien_so_xe', name: 'bien_so_xe'},
                {data: 'so_diem_tich_duoc', name: 'so_diem_tich_duoc'},
                {data: 'so_diem_hien_tai', name: 'so_diem_hien_tai'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $('#filterBtn').click(function() {
            table.ajax.reload(); // Tải lại DataTable với điều kiện lọc
        });

        $('body').on('click', '.EditLichSu', function () {
            var id = $(this).data('id'); // Lấy ID từ thuộc tính data-id của nút
            $.get("{{ route('admin.thongkediem.index') }}" + '/' + id + '/edit', function (data) {
                // Hiển thị modal
                $('#modelHeading').html("Đổi quà tặng");
                $('#QuaTangModel').modal('show');

                // Cập nhật tổng số quà tặng
                $('#tong_qua_tang').text(data.length); // Sử dụng data.length để lấy tổng số quà tặng

                // Xóa dữ liệu cũ trong bảng
                $('#lichSuDoiQuaBody').empty();

                // Kiểm tra nếu không có dữ liệu
                if (data.length === 0) {
                    $('#lichSuDoiQuaBody').append('<tr><td colspan="5" class="text-center">Không có dữ liệu</td></tr>');
                    return;
                }

                // Duyệt qua danh sách lịch sử và thêm vào bảng
                data.forEach(function(item) {
                    $('#lichSuDoiQuaBody').append(`
                        <tr>
                            <td>${new Date(item.created_at).toLocaleDateString()}</td>
                            <td>${item.khach_hang.ten_khach_hang}</td>
                            <td>${item.qua_tang.ten_qua_tang}</td>
                            <td>${item.qua_tang.so_diem_duoc_doi}</td>
                            <td>${item.qua_tang.ghi_chu}</td>
                        </tr>
                    `);
                });
            });
        });

        $('body').on('click', '.DeleteLichSu', function () {
            var id = $(this).data("id");
            $('#confirmDeleteModal').modal('show');
            $('#confirmDeleteBtn').off('click').on('click', function () {
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('admin.thongkediem.store') }}"+'/'+id,
                    success: function (data) {
                        table.ajax.reload();
                        toastr.success('Dữ liệu đã được xoá thành công.');
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        toastr.error('Có lỗi xảy ra khi xoá dữ liệu.');
                    }
                });

                $('#confirmDeleteModal').modal('hide');
            });
        });
    });
</script>
@endsection
