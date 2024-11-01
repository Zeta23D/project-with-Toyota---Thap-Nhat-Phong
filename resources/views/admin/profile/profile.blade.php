@extends('admin.master')
@section('title', 'Trang Chủ')

@section('main-content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Hồ sơ cá nhân</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
          <li class="breadcrumb-item active">Hồ sơ cá nhân</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->



<div class="container-fluid">
  <div class="row">
    <div class="col-md-3">

      <!-- Profile Image -->
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">
          <div class="text-center mt-1">
            <img id="profileImage" class="profile-user-img img-fluid" style="width: 200px"
                 src="{{ Auth::user()->avatar ? asset('uploads/photo/' . Auth::user()->avatar) : asset('assets/uploads/default/default.jpg') }}"
                 alt="User profile picture">
            <input type="file" id="imageUpload" style="display:none" accept="image/*">
        </div>

          <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>
          <p class="text-muted text-center">Thuộc đơn vị</p>

          <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
              @if ($latestKpi)
              <b>KPI Tháng {{ $latestKpi->thang }}: </b> <a class="float-right">{{ $latestKpi->diem }}</a>
              @else
              <b>KPI Tháng</b> <a class="float-right">1,322</a>
              @endif
            </li>
            <li class="list-group-item">
              <b>KPI Trung Bình</b> <a class="float-right">{{$averageKpi}}</a>
            </li>
            <li class="list-group-item">
              <b>Số lần được khen thưởng</b> <a class="float-right">1</a>
            </li>
          </ul>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->


      <!-- About Me Box -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Đôi lời về tôi</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <strong><i class="fas fa-book mr-1"></i> Giới thiệu</strong>

          <p class="text-muted">
            Xin chào
          </p>

          <hr>

          <strong><i class="fas fa-map-marker-alt mr-1"></i> Địa chỉ</strong>

          <p class="text-muted">Việt Nam</p>

          <hr>

          <strong><i class="fas fa-pencil-alt mr-1"></i> Kỹ năm</strong>

          <p class="text-muted">
            <span class="tag tag-danger">UI Design</span>
            <span class="tag tag-success">Coding</span>
            <span class="tag tag-info">Javascript</span>
            <span class="tag tag-warning">PHP</span>
            <span class="tag tag-primary">Node.js</span>
          </p>

          <hr>

          <strong><i class="far fa-file-alt mr-1"></i> Ghi chú</strong>

          <p class="text-muted">Đang làm việc tại...</p>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="card">
        <div class="card-header p-2">
          <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">Thông Tin KPI</a></li>
            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Đổi thông tin cá nhân</a></li>
          </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
          <div class="tab-content">

            <div class="tab-pane active" id="timeline">
                @foreach ($kpi_note as $kpi)
                <div class="timeline timeline-inverse" style="margin: 0px">
                    <div class="time-label">
                      <span class="bg-danger">
                        Tháng {{$kpi->thang}}- Năm 2024
                      </span>
                    </div>
                    <div>
                      <i class="fas fa-user bg-info"></i>
                      <div class="timeline-item">
                        <span class="time"><i class="far fa-clock"></i> Năm 2024</span>
                        <h3 class="timeline-header border-0"><a href="#">{{ Auth::user()->name }} </a> {{$kpi->ghi_chu}}                        </h3>
                      </div>
                    </div>
                  </div>
                @endforeach
            </div>

            <div class="tab-pane" id="settings">
              <form id="updateProfileForm" method="POST" action="{{ route('admin.profile.update') }}"
                class="form-horizontal">
                @csrf
                @method('PUT')

                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label">Tên người dùng</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputName" name="name" placeholder="Name"
                      value="{{ $user->name }}" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Tên đăng nhập</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail" name="email" placeholder="Email"
                      value="{{ $user->email }}" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Mật khẩu mới</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPassword" name="password"
                      placeholder="New Password">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputPasswordConfirmation" class="col-sm-2 col-form-label">Nhập lại mật khẩu mới</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPasswordConfirmation"
                      name="password_confirmation" placeholder="Confirm New Password">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="terms" required> Xác nhận  <a href="#">thay đổi mật khẩu</a>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <button type="submit" id="updateProfileBtn" class="btn btn-danger">Lưu thay đổi</button>
                  </div>
                </div>
              </form>
            </div>
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div><!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</div>
@endsection

@section('script')
<script>
  $(document).ready(function() {
    $('#updateProfileForm').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            success: function(response) {
                // Kiểm tra xem response có thuộc tính "toastr" và có giá trị là true không
                if (response.toastr) {
                    // Hiển thị thông báo toastr khi cập nhật thành công
                    toastr.success(response.message);
                }
            },
            error: function(xhr, status, error) {
                // Xử lý lỗi
                toastr.error(xhr.responseJSON.message);
            }
        });
    });

    // Thay đổi avatar
    $('#profileImage').click(function() {
        console.log('Image clicked'); // Debug: Kiểm tra xem sự kiện click có hoạt động không
        $('#imageUpload').click();
    });

            // Khi file được chọn, thay đổi ảnh đại diện
            $('#imageUpload').change(function(event) {
                console.log('File selected'); // Debug: Kiểm tra xem file có được chọn không
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#profileImage').attr('src', e.target.result);
                };
                reader.readAsDataURL(event.target.files[0]);

                // Gửi ảnh đại diện mới đến server để lưu lại
                var formData = new FormData();
                formData.append('avatar', event.target.files[0]);

                $.ajax({
                    url: '{{ route("profile.updateAvatar") }}', // Đường dẫn đến route xử lý việc cập nhật ảnh đại diện
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        toastr.success('Cập nhật ảnh thành công.');
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Có lỗi xảy ra khi cập nhật ảnh đại diện.');
                    }
                });
            });
        });
    </script>
@endsection
