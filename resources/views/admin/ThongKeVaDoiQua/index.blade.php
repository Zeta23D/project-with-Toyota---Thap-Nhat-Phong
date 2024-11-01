@extends('admin.master')
@section('title', 'Thống kê và đổi quà cho khánh hàng   ')

@section('main-content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{-- <h1 class="m-0">Nhân viên</h1> --}}
                    <button class="btn btn-success" id="DoiQuaTang">Đổi quà</button>
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
                        <div class="card-header">
                            <h3 class="card-title">Lịch sử đổi quà</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped dataTable">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên khách hàng</th>
                                            <th>Biển số xe</th>
                                            <th>Nhân viên thao tác  </th>
                                            <th>Quà vừa đổi </th>
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
                        <input type="hidden" name="id_nhanvien" id="id_nhanvien" value="{{Auth::user()->id}}">
                        <input type="hidden" name="id_lichsu_doiqua" id="id_lichsu_doiqua">
                        <input type="hidden" name="bien_so_xe" id="bien_so_xe">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Biển số xe</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="tim_bien_so_xe" name="tim_bien_so_xe"
                                            required="Nhập vào biển số xe khách hàng">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="ten_khach_hang" class="col-sm-12 control-label">Tên khách hàng</label>
                                <div class="col-sm-12">
                                    <input type="text" id="ten_khach_hang" class="form-control" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <label class="col-sm-12 control-label">Chọn quà tặng</label>
                                    <select name="id_quatang" id="id_quatang" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                        <option id_quatang="#">Chọn quà tặng</option>
                                        @foreach ($data_QuaTang as $item )
                                            <option value="{{$item->id_quatang}}" data-diem_qua="{{$item->so_diem_duoc_doi}}">{{$item->ten_qua_tang}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="col-sm-12 control-label">Điểm quà tặng</label>
                                    <input type="text" id="diem_qua" name="diem_doi_qua" class="form-control" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ghi_chu" class="col-sm-2 control-label">Ghi chú</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="ghi_chu" name="ghi_chu" placeholder="Nhập ghi chú" maxlength="255" required="">
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

    $('#id_quatang').on('change', function() {
            // Lấy giá trị data-diem_qua của option được chọn
            var diemQua = $(this).find(':selected').data('diem_qua');
            // Nếu có điểm quà thì hiển thị, nếu không thì xóa giá trị
            if (diemQua) {
                $('#diem_qua').val(diemQua);
            } else {
                $('#diem_qua').val('');
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

        $("#tim_bien_so_xe").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: '{{ route('khachhang.get') }}',
                        type: 'GET',
                        dataType: 'json',
                        data: {
                            term: request.term
                        },
                        success: function(data) {
                            response(data);
                        },
                        error: function(xhr, status, error) {
                            console.log("Error: " + error);
                        }
                    });
                },
                minLength: 1,
                select: function(event, ui) {

                    $('#ten_khach_hang').val(ui.item.ten_khach_hang); // Gán tên khách hàng vào input
                    $('#tim_bien_so_xe').val(ui.item.value); // Gán tên khách hàng vào input
                    $('#bien_so_xe').val(ui.item.value); // Gán id khách hàng vào input ẩn
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
            ajax: "{{ route('admin.thongkevadoiqua.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'ten_khach_hang', name: 'ten_khach_hang'},
                {data: 'bien_so_xe', name: 'bien_so_xe'},
                {data: 'ten_nhan_vien', name: 'ten_nhan_vien'},
                {data: 'qua_tang', name: 'qua_tang'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $('#DoiQuaTang').click(function () {
            $('#saveBtn').val("Xác nhận đổi quà");
            $('#id').val('');
            $('#quaTangForm').trigger("reset");
            $('#modelHeading').html("Đổi quà cho khách hàng");
            $('#QuaTangModel').modal('show');
        });


        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $(this).html('Sending..');
            $.ajax({
                data: $('#quaTangForm').serialize(),
                url: "{{ route('admin.thongkevadoiqua.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (response) {
                    $('#saveBtn').html('Lưu dữ liệu');
                    $('#quaTangForm').trigger("reset");
                    $('#QuaTangModel').modal('hide');
                    $('input').removeClass('is-invalid'); // Bỏ class tô đỏ
                    table.ajax.reload();
                    if (response.toastr) {
                        toastr.success(response.success);
                    }
                },
                error: function (data) {
                    $('#saveBtn').html('Lưu dữ liệu');
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
                    toastr.error(data.responseJSON.message ||data.responseJSON.errors ||'Đã xảy ra lỗi.');
                }
            });
        });

        $('body').on('click', '.EditLichSu', function () {
            var id = $(this).data('id');
            $.get("{{ route('admin.thongkevadoiqua.index') }}" +'/' + id +'/edit', function (data) {
                $('#modelHeading').html("Đổi quà tặng");
                $('#saveBtn').val("Đổi quà");
                $('#QuaTangModel').modal('show');
                $('#id_lichsu_doiqua').val(id);
                $('#id_nhanvien').val(data.id_nhanvien);
                $('#bien_so_xe').val(data.khach_hang.bien_so_xe);
                $('#tim_bien_so_xe').val(data.khach_hang.bien_so_xe);
                $('#ten_khach_hang').val(data.khach_hang.ten_khach_hang);
                $('#id_quatang').val(data.id_quatang).trigger('change');
            })
        });

        $('body').on('click', '.DeleteLichSu', function () {
            var id = $(this).data("id");
            $('#confirmDeleteModal').modal('show');
            $('#confirmDeleteBtn').off('click').on('click', function () {
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('admin.thongkevadoiqua.store') }}"+'/'+id,
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
