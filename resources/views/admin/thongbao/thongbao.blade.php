@extends('admin.master')
@section('title', 'Trang Chủ')

@section('main-content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                {{-- <h1 class="m-0">Nhân viên</h1> --}}
                <button class="btn btn-success" id="createNewThongBao">Thêm thông báo</button>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Thông báo</li>
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
                        <h3 class="card-title" style="color: red">Danh sách thông báo</h3>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped dataTable">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tiêu đề</th>
                                        <th>Nội dung</th>
                                        <th>File</th>
                                        <th width="150px">Trạng thái</th>
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
<div class="modal fade" id="ThongBaoModel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="thongbaoForm" name="thongbaoForm" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="form-group row">
                        <label for="title" class="col-sm-2 control-label">Tiêu đề</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="title" name="title"
                                placeholder="Nhập vào tiêu đề" maxlength="50" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="content" class="col-sm-2 control-label">Nội dung</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="content" name="content"
                                placeholder="Nhập vào nội dung" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="file_path" class="col-sm-2 control-label">File</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="file_path" name="file_path">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Lưu</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


{{-- Modal Delete --}}
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
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
            ajax: "{{ route('admin.thongbao.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'title', name: 'title'},
                {data: 'content', name: 'content'},
                {data: 'file_path', name: 'file_path'},
                {data: 'active', name: 'active', orderable: false, searchable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $('#createNewThongBao').click(function () {
            $('#saveBtn').val("create-ThongBao").html("Lưu");
            $('#id').val('');
            $('#thongbaoForm').trigger("reset");
            $('#modelHeading').html("Thêm mới thông báo");
            $('#ThongBaoModel').modal('show');
        });

        $('#saveBtn').click(function (e) {
            e.preventDefault(); // Ngăn chặn hành động mặc định của nút submit
            $(this).html('Đang lưu..'); // Thay đổi nội dung của nút

            var formData = new FormData($('#thongbaoForm')[0]);

            $.ajax({
                data: formData,
                url: "{{ route('admin.thongbao.store') }}",
                type: "POST",
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function (response) {
                    $('#thongbaoForm').trigger("reset");
                    $('#ThongBaoModel').modal('hide');
                    table.ajax.reload();
                    toastr.success(response.success);
                    $('#saveBtn').html('Lưu');
                },
                error: function (data) {
                    $('#saveBtn').html('Lưu');
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

        $('body').on('click', '.editThongBao', function () {
            var id = $(this).data('id');
            $.get("{{ route('admin.thongbao.index') }}" +'/' + id +'/edit', function (data) {
                $('#modelHeading').html("Chỉnh sửa thông báo");
                $('#saveBtn').val("edit-ThongBao").html("Lưu");
                $('#ThongBaoModel').modal('show');
                $('#id').val(data.id);
                $('#title').val(data.title);
                $('#content').val(data.content);
            })
        });

        $('body').on('click', '.deleteThongBao', function () {
            var id = $(this).data("id");
            $('#confirmDeleteModal').modal('show');

            $('#confirmDeleteBtn').off('click').on('click', function () {
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('admin.thongbao.store') }}"+'/'+id,
                    success: function () {
                        table.ajax.reload();
                        toastr.success('Dữ liệu đã được xoá thành công.');
                    },
                    error: function () {
                        toastr.error('Có lỗi xảy ra khi xoá dữ liệu.');
                    }
                });

                $('#confirmDeleteModal').modal('hide');
            });
        });

        $('body').on('change', '.active-select', function () {
            var ThongBaoId = $(this).data('id');
            var newRole = $(this).val();

            $.post("{{ route('admin.thongbao.changeRole', '') }}/" + ThongBaoId, {
                active: newRole,
                _token: $('meta[name="csrf-token"]').attr('content')
            })
            .done(function (data) {
                toastr.success(data.success);
            })
            .fail(function () {
                toastr.error('Error updating role');
            });
        });
    });
</script>
@endsection
