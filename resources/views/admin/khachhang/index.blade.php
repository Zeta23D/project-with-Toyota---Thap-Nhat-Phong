@extends('admin.master')
@section('title', 'Quản lý khách hàng')

@section('main-content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <button class="btn btn-success" id="createNewUser">Thêm mới khách hàng</button>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Quản lý khách hàng</li>
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
                        <div class="card-header">
                            <h3 class="card-title" style="color: red">Danh sách khách hàng</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="khachHangTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên khách hàng</th>
                                            <th>Số điện thoại</th>
                                            <th>Địa chỉ</th>
                                            <th>Biển số xe</th>
                                            <th>Số VIN</th>
                                            <th width="150px" style="text-align: center">Thao tác <span style="color: red">(Sửa - Xóa)</span></th>
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

    {{-- Modal ADD/EDIT --}}
    <div class="modal fade" id="khachHangModel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="khachHangForm" name="khachHangForm" class="form-horizontal">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="user_id" id="user_id">
                        <div class="form-group">
                            <label for="ten_khach_hang" class="col-sm-6 control-label">Tên khách hàng <span style="color: red">(*)</span></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="ten_khach_hang" name="ten_khach_hang" required>
                                <span class="text-danger" id="ten_khach_hang-error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="so_dien_thoai" class="col-sm-2 control-label">Số điện thoại</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="so_dien_thoai" name="so_dien_thoai" required>
                                <span class="text-danger" id="so_dien_thoai-error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dia_chi" class="col-sm-2 control-label">Địa chỉ</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="dia_chi" name="dia_chi">
                                <span class="text-danger" id="dia_chi-error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="bien_so_xe" class="col-sm-2 control-label">Biển số xe <span style="color: red">(*)</span></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="bien_so_xe" name="bien_so_xe">
                                <span class="text-danger" id="bien_so_xe-error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="so_vin" class="col-sm-2 control-label">Số VIN <span style="color: red">(*)</span></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="so_vin" name="so_vin">
                                <span class="text-danger" id="so_vin-error"></span>
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Lưu thay đổi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- Modal Delete --}}
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xác nhận xóa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn xóa bản ghi này không?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Xóa</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('#khachHangTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.khachhang.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'ten_khach_hang', name: 'ten_khach_hang'},
                    {data: 'so_dien_thoai', name: 'so_dien_thoai'},
                    {data: 'dia_chi', name: 'dia_chi'},
                    {data: 'bien_so_xe', name: 'bien_so_xe'},
                    {data: 'so_vin', name: 'so_vin'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

            $('#createNewUser').click(function () {
                $('#saveBtn').val("create-user");
                $('#id').val('');
                $('#khachHangForm').trigger("reset");
                $('#modelHeading').html("Thêm mới khách hàng");
                $('#khachHangModel').modal('show');
            });

            $('body').on('click', '.editUser', function () {
                var id = $(this).data('id');
                $.get("{{ route('admin.khachhang.index') }}" +'/' + id +'/edit', function (data) {
                    $('#modelHeading').html("Chỉnh sửa khách hàng");
                    $('#saveBtn').val("edit-user");
                    $('#khachHangModel').modal('show');
                    $('#id').val(data.id);
                    $('#ten_khach_hang').val(data.ten_khach_hang);
                    $('#so_dien_thoai').val(data.so_dien_thoai);
                    $('#dia_chi').val(data.dia_chi);
                    $('#bien_so_xe').val(data.bien_so_xe);
                    // $('#email').val(data.user.email);
                    // $('#user_id').val(data.user_id);
                })
            });
$('#saveBtn').click(function (e) {
    e.preventDefault(); // Ngăn chặn hành động mặc định của nút submit
    $(this).html('Đang lưu..'); // Thay đổi nội dung của nút

    $.ajax({
        data: $('#khachHangForm').serialize(), // Lấy dữ liệu từ form
        url: "{{ route('admin.khachhang.store') }}", // Đường dẫn đến API
        type: "POST", // Phương thức gửi dữ liệu
        dataType: 'json', // Kiểu dữ liệu trả về
        success: function (data) {
            $('#khachHangForm').trigger("reset"); // Reset form
            $('#khachHangModel').modal('hide'); // Đóng modal
            table.ajax.reload(); // Cập nhật bảng
            toastr.success(data.success); // Hiển thị thông báo thành công
        },
        error: function (data) {
            $('#saveBtn').html('Lưu'); // Khôi phục nội dung nút
            console.log("data:", data); // Hiển thị dữ liệu lỗi trên console

            // Xóa các thông báo lỗi trước đó
            $('input').removeClass('is-invalid'); // Bỏ class tô đỏ
            $('.text-danger').html(''); // Xóa thông báo lỗi cũ

            // Kiểm tra nếu server trả về lỗi xác thực
            if (data.status === 422) {
                var errors = data.responseJSON.errors; // Lấy lỗi từ server

                // Duyệt qua từng lỗi và xử lý
                $.each(errors, function (key, value) {
                    // Tô đỏ input có lỗi
                    $('input[name=' + key + ']').addClass('is-invalid');

                    // Thêm thông báo lỗi dưới input
                    $('#' + key + '-error').html(value[0]); // Hiển thị thông báo lỗi
                });
            }
            // Hiển thị thông báo lỗi tổng quát
            toastr.error(data.responseJSON.message || 'Đã xảy ra lỗi.');
        }
    });
});

            $('body').on('click', '.deleteUser', function () {
                var id = $(this).data("id");
                $('#confirmDeleteModal').modal('show');
                $('#confirmDeleteButton').click(function () {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('admin.khachhang.store') }}"+'/'+id,
                        success: function (data) {
                            $('#confirmDeleteModal').modal('hide');
                            table.draw();
                            toastr.success(data.success);
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                });
            });

        });
    </script>
@endsection
