@extends('admin.master')
@section('title', 'Quản lý tiêu chí KPI')

@section('main-content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <button class="btn btn-success" id="createNewUser">Thêm mới</button>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Quản lý tiêu chí KPI</li>
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
                            <h3 class="card-title">Danh sách</h3>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Mục lớn</th>
                                            <th>Mục nhỏ</th>
                                            <th>Nội dung</th>
                                            <th>Điểm chuẩn</th>
                                            <th width="150px" style="text-align: center">Thao tác</th>
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
    <div class="modal fade" id="KPIModel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="kpisForm" name="kpisForm" class="form-horizontal">
                     @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="muc_lon" class="col-sm-2 control-label">Mục lớn</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="muc_lon" name="muc_lon" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="muc_nho" class="col-sm-2 control-label">Mục nhỏ</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="muc_nho" name="muc_nho" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="noi_dung_danh_gia" class="col-sm-2 control-label">Nội dung</label>
                            <div class="col-sm-12">
                                <textarea class="form-control" id="noi_dung_danh_gia" name="noi_dung_danh_gia" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="diem_chuan" class="col-sm-2 control-label">Điểm chuẩn</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="diem_chuan" name="diem_chuan" required>
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
    var table = $('#example1').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "{{ route('admin.kpi_tieuchi.index') }}",
        "columns": [
            {"data": "DT_RowIndex", "name": "DT_RowIndex"},
            {"data": "muc_lon", "name": "muc_lon"},
            {"data": "muc_nho", "name": "muc_nho"},
            {"data": "noi_dung_danh_gia", "name": "noi_dung_danh_gia"},
            {"data": "diem_chuan", "name": "diem_chuan"},
            {"data": "action", "name": "action", "orderable": false, "searchable": false}
        ],
        "stateSave": true // Thêm dòng này để lưu trạng thái của bảng
    });

    $('#createNewUser').click(function () {
        $('#saveBtn').val("create-user");
        $('#id').val('');
        $('#kpisForm').trigger("reset");
        $('#modelHeading').html("Thêm mới tiêu chí");
        $('#KPIModel').modal('show');
    });

    $('body').on('click', '.editUser', function () {
        var id = $(this).data('id');
        $.get("{{ route('admin.kpi_tieuchi.index') }}" +'/' + id +'/edit', function (data) {
            $('#modelHeading').html("Chỉnh sửa tiêu chí");
            $('#saveBtn').val("edit-user");
            $('#KPIModel').modal('show');
            $('#id').val(data.id);
            $('#muc_lon').val(data.muc_lon);
            $('#muc_nho').val(data.muc_nho);
            $('#noi_dung_danh_gia').val(data.noi_dung_danh_gia);
            $('#diem_chuan').val(data.diem_chuan);
        });
    });

    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Đang gửi...');

        var currentPage = table.page(); // Lưu trang hiện tại

        $.ajax({
            data: $('#kpisForm').serialize(),
            url: "{{ route('admin.kpi_tieuchi.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (response) {
                $('#kpisForm').trigger("reset");
                $('#KPIModel').modal('hide');
                table.ajax.reload(null, false); // Giữ lại trang hiện tại sau khi reload
                table.page(currentPage).draw(false); // Trở lại trang hiện tại sau khi reload
                toastr.success(response.success);
                $('#saveBtn').html('Lưu thay đổi');
            },
            error: function (data) {
                console.log('Error:', data);
                $('#saveBtn').html('Lưu thay đổi');
                toastr.error('Có lỗi xảy ra khi lưu dữ liệu.');
            }
        });
    });

    $('body').on('click', '.deleteUser', function () {
        var id = $(this).data("id");
        $('#confirmDeleteModal').modal('show');
        $('#confirmDeleteBtn').off('click').on('click', function () {
            var currentPage = table.page(); // Lưu trang hiện tại

            $.ajax({
                type: "DELETE",
                url: "{{ route('admin.kpi_tieuchi.store') }}"+'/'+id,
                success: function (data) {
                    $('#confirmDeleteModal').modal('hide');
                    table.ajax.reload(null, false); // Giữ lại trang hiện tại sau khi reload
                    table.page(currentPage).draw(false); // Trở lại trang hiện tại sau khi reload
                    toastr.success('Dữ liệu đã được xoá thành công.');
                },
                error: function (data) {
                    console.log('Error:', data);
                    toastr.error('Có lỗi xảy ra khi xoá dữ liệu.');
                }
            });
        });
    });
});

</script>
@endsection
