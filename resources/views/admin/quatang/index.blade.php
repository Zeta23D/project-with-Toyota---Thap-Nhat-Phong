@extends('admin.master')
@section('title', 'Quản Lý Quà Đổi')

@section('main-content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                {{-- <h1 class="m-0">Nhân viên</h1> --}}
                <button class="btn btn-success" id="createNewUser">Thêm quà tặng</button>
                {{-- <button class="btn btn-primary" data-toggle="modal" data-target="#importModal">Import
                    Excel</button> --}}
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">TOYOTA</a></li>
                    <li class="breadcrumb-item active">Quản lý quà tặng</li>
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
                            <table id="example1" class="table table-bordered table-striped dataTable">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên quà tặng</th>
                                        <th>Số điểm đổi được</th>
                                        <th>Ghi chú</th>
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

{{-- Modal ADD --}}
<div class="modal fade" id="QuaTangModel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="quaTangForm" name="quaTangForm" class="form-horizontal">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="ten_qua_tang" class="col-sm-12 control-label">Tên quà tặng <span style="color: red">(*)</span></label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="ten_qua_tang" name="ten_qua_tang"
                                placeholder="Nhập vào tên quà tặng....">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="so_diem_duoc_doi" class="col-sm-12 control-label">Số điểm được đổi <span style="color: red">(*)</span></label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="so_diem_duoc_doi" name="so_diem_duoc_doi"
                                placeholder="Nhập số điểm cần đổi......" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ghi_chu" class="col-sm-12 control-label">Ghi chú</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="ghi_chu" name="ghi_chu"
                                placeholder="Nhập ghi chú" maxlength="255" required="">
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Lưu dữ liệu</button>
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
            ajax: "{{ route('admin.qua_doi.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'ten_qua_tang', name: 'ten_qua_tang'},
                {data: 'so_diem_duoc_doi', name: 'so_diem_duoc_doi'},
                {data: 'ghi_chu', name: 'ghi_chu'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $('#createNewUser').click(function () {
            $('#saveBtn').val("create-user");
            $('#id').val('');
            $('#quaTangForm').trigger("reset");
            $('#modelHeading').html("Thêm quà tặng");
            $('#QuaTangModel').modal('show');
        });

        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $(this).html('Đang lưu..');

            $.ajax({
                data: $('#quaTangForm').serialize(),
                url: "{{ route('admin.qua_doi.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (response) {
                    $('input').removeClass('is-invalid'); 
                    $('#quaTangForm').trigger("reset");
                    $('#QuaTangModel').modal('hide');
                    table.ajax.reload();
                    toastr.success(response.success);
                    $('#saveBtn').html('Lưu');
                },
                error: function (data) {
                    $('input').removeClass('is-invalid'); // Bỏ class tô đỏ
                    $('.text-danger').html(''); // Xóa thông báo lỗi cũ
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


        $('body').on('click', '.editQuaTang', function () {
            var id = $(this).data('id');
            $.get("{{ route('admin.qua_doi.index') }}" +'/' + id +'/edit', function (data) {
                $('#modelHeading').html("Edit User");
                $('#saveBtn').val("Sửa quà tặng");
                $('#QuaTangModel').modal('show');
                $('#id').val(data.id_quatang);
                $('#ten_qua_tang').val(data.ten_qua_tang);
                $('#so_diem_duoc_doi').val(data.so_diem_duoc_doi);
                $('#ghi_chu').val(data.ghi_chu);
            })
        });

        $('body').on('click', '.deleteQuaTang', function () {
            var id = $(this).data("id");
            $('#confirmDeleteModal').modal('show');
            $('#confirmDeleteBtn').off('click').on('click', function () {
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('admin.qua_doi.store') }}"+'/'+id,
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
