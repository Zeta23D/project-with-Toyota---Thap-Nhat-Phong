@extends('admin.master')
@section('title', 'Trang Chủ')

@section('main-content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{-- <h1 class="m-0">Nhân viên</h1> --}}
                <button class="btn btn-success" id="createNewUser">Thêm nhân viên</button>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
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
                            <h3 class="card-title" style="color: red">Danh sách nhân viên</h3>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped dataTable">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên người dùng</th>
                                            <th>Tên đăng nhập</th>
                                            <th>Địa chỉ</th>
                                            <th>Vai trò</th>
                                            <th>Xét NV tiêu biểu</th>
                                            <th width="150px" style="text-align: center">Thao tác <span style="color: red;">(Sửa & Xóa)</span></th>
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
    <div class="modal fade" id="userModel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="usersForm" name="usersForm" class="form-horizontal">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="name" class="col-sm-6 control-label">Tên nhân viên</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên nhân viên..." value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-6 control-label" style="color: red">Tài khoản đăng nhập</label>
                            <div class="col-sm-12">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Nhập tài khoản đăng nhập..." value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label">Địa chỉ</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="address" name="address" placeholder="Nhập địa chỉ..." value="" required="">
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Thêm</button>
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
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Xác nhận</button>
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

    $(function () {
        var table = $('.dataTable').DataTable({
            responsive: true,
            autoWidth: false,
            ajax: "{{ route('admin.users.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'address', name: 'address'},
                {data: 'usertype', name: 'usertype', orderable: false, searchable: false},
                {data: 'start_user', name: 'start_user', orderable: false, searchable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $('#createNewUser').click(function () {
            $('#saveBtn').val("create-user");
            $('#id').val('');
            $('#usersForm').trigger("reset");
            $('#modelHeading').html("Thêm mới người dùng");
            $('#userModel').modal('show');
        });

        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $(this).html('Sending..');

            $.ajax({
                data: $('#usersForm').serialize(),
                url: "{{ route('admin.users.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (response) {
                    $('#usersForm').trigger("reset");
                    $('#userModel').modal('hide');
                    table.ajax.reload(); // Sử dụng ajax.reload() thay vì draw() để reload lại dữ liệu

                    if (response.toastr) {
                        toastr.success(response.success);
                    }
                },
                error: function (data) {
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
                    toastr.error(data.responseJSON.message || 'Đã xảy ra lỗi.');
                }
            });
        });

        $('body').on('click', '.editUser', function () {
            var id = $(this).data('id');
            $.get("{{ route('admin.users.index') }}" +'/' + id +'/edit', function (data) {
                $('#modelHeading').html("Edit User");
                $('#saveBtn').val("edit-User");
                $('#userModel').modal('show');
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#address').val(data.address);
            })
        });

        $('body').on('click', '.deleteUser', function () {
            var id = $(this).data("id");
            $('#confirmDeleteModal').modal('show');

            // Remove any previous click event handlers attached to #confirmDeleteBtn
            $('#confirmDeleteBtn').off('click').on('click', function () {
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('admin.users.store') }}"+'/'+id,
                    success: function (data) {
                        table.ajax.reload(); // Sử dụng ajax.reload() để reload lại dữ liệu
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

        // Phân Quyền Nhân Viên
        $('body').on('change', '.usertype-select', function () {
            var userId = $(this).data('id');
            var newRole = $(this).val();

            $.ajax({
                url: '{{ route("admin.users.changeRole", ":id") }}'.replace(':id', userId),
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    usertype: newRole
                },
                success: function (data) {
                    toastr.success(data.success);
                },
                error: function (data) {
                    toastr.error('Error updating role');
                }
            });
        });

        // Xét nhân viên tiêu biểu
        $('body').on('change', '.start_user-select', function () {
            var userId = $(this).data('id');
            var newStart = $(this).val();

            $.ajax({
                url: '{{ route("admin.users.changeStart", ":id") }}'.replace(':id', userId),
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    userstart: newStart
                },
                success: function (data) {
                    toastr.success(data.success);
                },
                error: function (data) {
                    toastr.error('Error updating role');
                }
            });
        });

    });
</script>


@endsection
