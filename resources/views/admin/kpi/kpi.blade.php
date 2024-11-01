@extends('admin.master')
@section('title', 'Trang Chủ')

@section('main-content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{-- <h1 class="m-0">Nhân viên</h1> --}}
                    <button class="btn btn-success" id="createNewUser">Thêm điểm</button>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#importModal">Import Excel</button>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Quản lý điểm KPI</li>
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
                                            <th>Tên nhân viên</th>
                                            <th>Điểm</th>
                                            <th>Tháng</th>
                                            <th>Năm</th>
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
                            <label for="name" class="col-sm-2 control-label">Tên nhân viên</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" name="name" required="Nhập vào tên nhân viên">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="diem" class="col-sm-2 control-label">Điểm</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="diem" name="diem" placeholder="Nhập điểm KPI" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="thang" class="col-sm-2 control-label">Tháng</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="thang" name="thang" required="">
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}">Tháng {{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ghi_chu" class="col-sm-2 control-label">Ghi chú</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="ghi_chu" name="ghi_chu" placeholder="Nhập ghi chú" maxlength="255" required="">
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Import --}}
    <div class="modal fade" id="importModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Import KPI từ Excel</h4>
                </div>
                <div class="modal-body">
                <form id="importForm" name="importForm" class="form-horizontal" action="{{ route('kpis.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="file" class="col-sm-2 control-label">File Excel</label>
                        <div class="col-sm-12">
                            <input type="file" class="form-control" id="file" name="file" required>
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Import</button>
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

    $(document).ready(function () {
        // Cấu hình Toastr
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "5000",
        };

        $("#name").autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: '{{ route('users.get') }}',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        term: request.term
                    },
                    success: function (data) {
                        var names = $.map(data, function (obj) {
                            return obj.name;
                        });
                        response(names);
                    },
                    error: function (xhr, status, error) {
                        console.log("Error: " + error);
                    }
                });
            },
            minLength: 1,
            select: function (event, ui) {
                $('#name').val(ui.item.value);
                return false;
            }
        });

        var table = $('.dataTable').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            ajax: "{{ route('admin.kpi.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'diem', name: 'diem'},
                {data: 'thang', name: 'thang'},
                {data: 'nam', name: 'nam'},
                {data: 'ghi_chu', name: 'ghi_chu'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $('#createNewUser').click(function () {
            $('#saveBtn').val("create-user");
            $('#id').val('');
            $('#kpisForm').trigger("reset");
            $('#modelHeading').html("Thêm mới người dùng");
            $('#KPIModel').modal('show');
        });

        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $(this).html('Sending..');

            $.ajax({
                data: $('#kpisForm').serialize(),
                url: "{{ route('admin.kpi.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (response) {
                    $('#kpisForm').trigger("reset");
                    $('#KPIModel').modal('hide');
                    table.ajax.reload();
                    if (response.toastr) {
                        toastr.success(response.success);
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save changes');
                    toastr.error('Có lỗi xảy ra khi lưu dữ liệu.');
                }
            });
        });

        $('#importForm').on('submit', function (e) {
            e.preventDefault();
            var formData = new FormData(this); // Lấy dữ liệu từ form

            $.ajax({
                url: "{{ route('kpis.import') }}", // URL của route xử lý import
                type: "POST",
                data: formData,
                contentType: false, // Không đặt kiểu nội dung vì sử dụng FormData
                processData: false, // Không xử lý dữ liệu
                success: function (response) {
                    $('#importForm').trigger("reset");
                    $('#importModal').modal('hide'); // Ẩn modal import
                    table.ajax.reload(); // Cập nhật lại danh sách
                    if (response.toastr) {
                        toastr.success(response.success);
                    }
                },
                error: function (xhr) {
                    toastr.error('Có lỗi xảy ra khi import dữ liệu.');
                    console.log(xhr.responseText);
                }
            });
        });

        $('body').on('click', '.editUser', function () {
            var id = $(this).data('id');
            $.get("{{ route('admin.kpi.index') }}" +'/' + id +'/edit', function (data) {
                $('#modelHeading').html("Edit User");
                $('#saveBtn').val("edit-User");
                $('#KPIModel').modal('show');
                $('#id').val(data.id_kpi);
                $('#name').val(data.name);
                $('#diem').val(data.diem);
                $('#thang').val(data.thang);
                $('#ghi_chu').val(data.ghi_chu);
            })
        });

        $('body').on('click', '.deleteUser', function () {
            var id = $(this).data("id");
            $('#confirmDeleteModal').modal('show');
            $('#confirmDeleteBtn').off('click').on('click', function () {
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('admin.kpi.store') }}"+'/'+id,
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
