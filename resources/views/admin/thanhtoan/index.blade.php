@extends('admin.master')
@section('title', 'Hóa Đơn Tích Điểm')

@section('main-content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{-- <h1 class="m-0">Nhân viên</h1> --}}
                    <button class="btn btn-success" id="createNewHDTD">Thêm hóa đơn tích điểm</button>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">TOYOTA</a></li>
                        <li class="breadcrumb-item active">HÓA ĐƠN TÍCH ĐIỂM</li>
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
                            <h3 class="card-title">Danh sách hóa đơn</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped dataTable">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên khách hàng</th>
                                            <th>Biển số xe</th>
                                            <th>Số tiền thanh toán</th>
                                            <th>Điểm quy đổi</th>
                                            <th>Nhân viên lên đơn</th>
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
    <div class="modal fade" id="HoaDonTichDiemModel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="HoaDonTichDiemForm" name="HoaDonTichDiemForm" class="form-horizontal">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="id_nhanvien" id="id_nhanvien" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="bien_so_xe" id="bien_so_xe">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Biển số xe</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="tim_bien_so_xe" name="tim_bien_so_xe"
                                    required="Nhập vào biển số xe khách hàng">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="diem" class="col-sm-4 control-label">Số tiền thanh toán</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="so_tien_thanh_toan" name="so_tien_thanh_toan"
                                    placeholder="Nhập vào số tiền thanh toán" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Lưu hóa
                                đơn</button>
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

@section('script')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
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
                    $('#tim_bien_so_xe').val(ui.item.value); // Gán tên khách hàng vào input
                    $('#bien_so_xe').val(ui.item.value); // Gán id khách hàng vào input ẩn
                    return false;

                }
            });

            $(document).ready(function() {
                $('#so_tien_thanh_toan').on('input', function() {
                    var input = $(this);
                    // Lấy giá trị từ input và loại bỏ các ký tự không phải số
                    var numberValue = input.val().replace(/[^0-9]/g, '');

                    // Định dạng lại giá trị với dấu phẩy và set lại vào input
                    if ($.isNumeric(numberValue)) {
                        var formattedValue = new Intl.NumberFormat('en-US').format(numberValue);
                        input.val(formattedValue);
                    }
                });

                $('#so_tien_thanh_toan').on('keypress', function(e) {
                    // Chỉ cho phép nhập ký tự số
                    if (e.which < 48 || e.which > 57) {
                        e.preventDefault();
                    }
                });

                // Hàm chuyển đổi và tính điểm sau khi lấy giá trị đã được định dạng từ input
                $('#calculatePoints').on('click', function() {
                    // Lấy giá trị từ input và loại bỏ dấu phẩy
                    var rawValue = $('#so_tien_thanh_toan').val().replace(/,/g, '');
                    var soTienThanhToan = parseInt(rawValue, 10);

                    // Kiểm tra và tính toán nếu giá trị là số hợp lệ
                    if (!isNaN(soTienThanhToan)) {
                        var diemMoi = soTienThanhToan / 100000;
                        alert("Điểm quy đổi: " + diemMoi);
                    } else {
                        alert("Vui lòng nhập một số tiền hợp lệ.");
                    }
                });
            });





            var table = $('.dataTable').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                ajax: "{{ route('admin.tichdiemkhachhang.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'khach_hang',
                        name: 'khach_hang'
                    },
                    {
                        data: 'bien_so_xe',
                        name: 'bien_so_xe'
                    },
                    {
                        data: 'so_tien_thanh_toan',
                        name: 'so_tien_thanh_toan',
                        render: function(data, type, row) {
                            return new Intl.NumberFormat('vi-VN').format(
                            data); // Định dạng thành 1.234.567
                        }
                    },
                    {
                        data: 'diem_quy_doi',
                        name: 'diem_quy_doi'
                    },
                    {
                        data: 'nhan_vien',
                        name: 'nhan_vien'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $('#createNewHDTD').click(function() {
                $('#saveBtn').val("create-HDTD");
                $('#id').val('');
                $('#HoaDonTichDiemForm').trigger("reset");
                $('#modelHeading').html("Thêm mới hóa đơn tích điểm");
                $('#HoaDonTichDiemModel').modal('show');
            });

            $('#saveBtn').click(function(e) {
                e.preventDefault();
                $(this).html('Xin vui lòng đợi....');
                $.ajax({
                    data: $('#HoaDonTichDiemForm').serialize(),
                    url: "{{ route('admin.tichdiemkhachhang.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(response) {
                        $('#saveBtn').html('Lưu dữ liệu');
                        $('#HoaDonTichDiemForm').trigger("reset");
                        $('#HoaDonTichDiemModel').modal('hide');
                        table.ajax.reload();
                        if (response.toastr) {
                            toastr.success(response.success);
                        }
                    },
                    error: function(data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('Lưu dữ liệu');
                        toastr.error('Có lỗi xảy ra khi lưu dữ liệu.');
                    }
                });
            });

            $('body').on('click', '.editHoaDon', function() {
                var id = $(this).data('id');
                $.get("{{ route('admin.tichdiemkhachhang.index') }}" + '/' + id + '/edit', function(data) {
                    console.log(data);
                    $('#modelHeading').html("Sửa hóa đơn tích điểm");
                    $('#saveBtn').val("edit-HoaDon");
                    $('#HoaDonTichDiemModel').modal('show');
                    $('#id').val(data.id_hoadon);
                    $('#id_khach_hang').val(data.id_khach_hang);
                    $('#bien_so_xe').val(data.khach_hang.bien_so_xe);
                    $('#tim_bien_so_xe').val(data.khach_hang.bien_so_xe);
                    $('#so_tien_thanh_toan').val(data.so_tien_thanh_toan);
                    $('#id_nhanvien').val(data.id_nhanvien);
                })
            });

            $('body').on('click', '.deleteHoaDon', function() {
                var id = $(this).data("id");
                $('#confirmDeleteModal').modal('show');
                $('#confirmDeleteBtn').off('click').on('click', function() {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('admin.tichdiemkhachhang.store') }}" + '/' + id,
                        success: function(data) {
                            table.ajax.reload();
                            toastr.success('Dữ liệu đã được xoá thành công.');
                        },
                        error: function(data) {
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
