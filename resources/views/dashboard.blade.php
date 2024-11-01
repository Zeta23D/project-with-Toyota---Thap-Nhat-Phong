
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Đại Lý Toyota Vĩnh Long - Thập Nhất Phong | Phần Mềm & Dịch Vụ Toyota Chính Hãng</title>

  <meta content="Đại lý Toyota chính hãng tại Vĩnh Long - Thập Nhất Phong. Cung cấp dịch vụ bảo dưỡng xe Toyota, mua xe Toyota uy tín và chất lượng." name="description">
  <meta content="Toyota Vĩnh Long, Thập Nhất Phong, Toyota phần mềm, mua xe Toyota, bảo dưỡng Toyota, Toyota Vĩnh Long chính hãng, Toyota phần mềm bảo dưỡng" name="keywords">

  <!-- Favicons -->
  <link href="assets_site/img/logo1.png" rel="icon">
  <link href="assets_site/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets_site/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets_site/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets_site/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets_site/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets_site/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets_site/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets_site/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets_site/css/style.css" rel="stylesheet">

</head>

<body>

  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">
      <div class="logo">
        <h1><a href="index.html">TOYOTA - THẬP NHẤT PHONG</a></h1>
        <!-- <a href="index.html"><img src="assets_site/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Trang chủ</a></li>
          <li><a class="nav-link scrollto" href="#about">Giới thiệu</a></li>
          <li><a class="nav-link scrollto" href="#services">Dịch vụ</a></li>
          <li><a class="nav-link scrollto " href="#portfolio">Sản phẩm</a></li>
          <li><a class="nav-link scrollto" href="#team">Nhân viên</a></li>
          <li><a class="nav-link scrollto" href="#contact">Liên hệ</a></li>
          @if(auth()->user() != null)
            <li><a class="getstarted scrollto" href="/admin/dashboard">Trang chủ Admin</a></li>
          @else
            <li><a class="getstarted scrollto" href="/login">Đăng nhập</a></li>
          @endif

        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
          <h1 data-aos="fade-up">TOYOTA - THẬP NHẤT PHONG VĨNH LONG</h1>
          <h2 data-aos="fade-up" data-aos-delay="400">Hỗ Trợ Giá Tốt, Nhiều Ưu Đãi, Trả Góp Lãi Thấp</h2>
          <div data-aos="fade-up" data-aos-delay="800">
            <a href="https://toyotavinhlongthapnhatphong.vn/" class="btn-get-started scrollto">Tìm hiểu thêm</a>
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="fade-left" data-aos-delay="200">
          <img src="assets_site/img/panel.png" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Clients Section ======= -->
    <section id="clients" class="clients clients">
      <div class="container">

        <div class="row">

          <div class="col-lg-2 col-md-4 col-6">
            <img src="assets_site/img/clients/camry.png" class="img-fluid" alt="" data-aos="zoom-in">
          </div>

          <div class="col-lg-2 col-md-4 col-6">
            <img src="assets_site/img/clients/camry.png" class="img-fluid" alt="" data-aos="zoom-in" data-aos-delay="100">
          </div>

          <div class="col-lg-2 col-md-4 col-6">
            <img src="assets_site/img/clients/camry.png" class="img-fluid" alt="" data-aos="zoom-in" data-aos-delay="200">
          </div>

          <div class="col-lg-2 col-md-4 col-6">
            <img src="assets_site/img/clients/camry.png" class="img-fluid" alt="" data-aos="zoom-in" data-aos-delay="300">
          </div>

          <div class="col-lg-2 col-md-4 col-6">
            <img src="assets_site/img/clients/camry.png" class="img-fluid" alt="" data-aos="zoom-in" data-aos-delay="400">
          </div>

          <div class="col-lg-2 col-md-4 col-6">
            <img src="assets_site/img/clients/camry.png" class="img-fluid" alt="" data-aos="zoom-in" data-aos-delay="500">
          </div>

        </div>

      </div>
    </section><!-- End Clients Section -->

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>VỀ TOYOTA - THẬP NHẤT PHONG</h2>
        </div>

        <div class="row content">
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="150">
            <p style="text-align: center; color: red">
                THƯƠNG HIỆU UY TÍNH - ƯU ĐÃI NHIỀU - GIAO XE NHANH <br> KHUYẾN MÃI TỐT NHẤT - DỊCH VỤ TẬN TÂM
            </p>
            <ul>
              <li><i class="ri-check-double-line"></i> Giá Xe Toyota Lăn bánh Ưu đãi, khuyến mãi lớn, trả góp Vios, Altis, Cross, Veloz, Avanza, Camry, Fortuner, Raize, Yaris, Innova, Wigo, Hilux</li>
              <li><i class="ri-check-double-line"></i> Hỗ trợ mua trả góp Toyota, Lãi Suất ưu đãi tốt nhất từ TFS Việt Nam. Tính Dự Toán Trả Góp</li>
              <li><i class="ri-check-double-line"></i> Chương trình khuyến mãi mới nhất hiện nay khi mua xe Toyota</li>
            </ul>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0" data-aos="fade-up" data-aos-delay="300">
            <p>
                Dịch vụ sửa chữa, bảo hành, bảo dưỡng, cung cấp phụ tùng và phụ kiện chính hãng. Nhiều chương trình ưu đãi..........
            </p>
            <a href="https://toyotavinhlongthapnhatphong.vn/" class="btn-learn-more">Chi tiết</a>
          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
      <div class="container">

        <div class="row">
          <div class="image col-xl-5 d-flex align-items-stretch justify-content-center justify-content-xl-start" data-aos="fade-right" data-aos-delay="150">
            <img src="assets_site/img/counts-img.svg" alt="" class="img-fluid">
          </div>

          <div class="col-xl-7 d-flex align-items-stretch pt-4 pt-xl-0" data-aos="fade-left" data-aos-delay="300">
            <div class="content d-flex flex-column justify-content-center">
              <div class="row">
                <div class="col-md-6 d-md-flex align-items-md-stretch">
                  <div class="count-box">
                    <i class="bi bi-emoji-smile"></i>
                    <span data-purecounter-start="0" data-purecounter-end="862" data-purecounter-duration="1" class="purecounter"></span>
                    <p><strong>Sự hài lòng của quý khách</strong> à kết quả niềm vui của chúng tôi như một điều gì đó mà chính người kiến ​​trúc sư đã làm.</p>
                  </div>
                </div>

                <div class="col-md-6 d-md-flex align-items-md-stretch">
                  <div class="count-box">
                    <i class="bi bi-journal-richtext"></i>
                    <span data-purecounter-start="0" data-purecounter-end="85" data-purecounter-duration="1" class="purecounter"></span>
                    <p><strong>TOYOTA</strong> rất nhiều xe đang chờ đón bạn tới lựa chọn</p>
                  </div>
                </div>

                <div class="col-md-6 d-md-flex align-items-md-stretch">
                  <div class="count-box">
                    <i class="bi bi-clock"></i>
                    <span data-purecounter-start="0" data-purecounter-end="4" data-purecounter-duration="1" class="purecounter"></span>
                    <p><strong>Cột mốc</strong> Showroom Toyota Thập Nhất Phong Vĩnh Long chính thức đi vào hoạt động từ ngày 23/02/2021</p>
                  </div>
                </div>

                <div class="col-md-6 d-md-flex align-items-md-stretch">
                  <div class="count-box">
                    <i class="bi bi-award"></i>
                    <span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="1" class="purecounter"></span>
                    <p><strong>TOYOTA</strong>đạt nhiều thành tính và huy chương</p>
                  </div>
                </div>
              </div>
            </div><!-- End .content-->
          </div>
        </div>

      </div>
    </section><!-- End Counts Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>DỊCH VỤ CỦA CHÚNG TÔI</h2>
          <p>MỘT SỐ DỊCH VỤ TẠI TOYOTA - THẬP NHẤT PHONG VĨNH LONG</p>
        </div>

        <div class="row">
          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
              <div class="icon"><i class="bx bxl-dribbble"></i></div>
              <h4 class="title"><a href="">ĐẶC HẸN DỊCH VỤ</a></h4>
              <p class="description">ĐẶT HẸN LÀ MỘT DỊCH VỤ ĐƯỢC DÙNG ĐỂ TIẾT KIỆM THỜI GIAN CHO QUÝ KHÁCH</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
              <div class="icon"><i class="bx bx-file"></i></div>
              <h4 class="title"><a href="">BẢO DƯỠNG ĐỊNH KỲ</a></h4>
              <p class="description">Kiểm tra, bảo dưỡng định kỳ</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
              <div class="icon"><i class="bx bx-tachometer"></i></div>
              <h4 class="title"><a href="">BẢO DƯỠNG NHANH</a></h4>
              <p class="description">BẢO DƯỠNG NHANH - SIÊU TIẾT KIỆM THỜI GIAN</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
              <div class="icon"><i class="bx bx-world"></i></div>
              <h4 class="title"><a href="">Nemo Enim</a></h4>
              <p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Services Section -->

    <!-- ======= Features Section ======= -->
    {{-- <section id="features" class="features">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>ĐẶC TRƯNG</h2>
          <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem</p>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="300">
          <div class="col-lg-3 col-md-4">
            <div class="icon-box">
              <i class="ri-store-line" style="color: #ffbb2c;"></i>
              <h3><a href="">Lorem Ipsum</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
            <div class="icon-box">
              <i class="ri-bar-chart-box-line" style="color: #5578ff;"></i>
              <h3><a href="">Dolor Sitema</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
            <div class="icon-box">
              <i class="ri-calendar-todo-line" style="color: #e80368;"></i>
              <h3><a href="">Sed perspiciatis</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4 mt-lg-0">
            <div class="icon-box">
              <i class="ri-paint-brush-line" style="color: #e361ff;"></i>
              <h3><a href="">Magni Dolores</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box">
              <i class="ri-database-2-line" style="color: #47aeff;"></i>
              <h3><a href="">Nemo Enim</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box">
              <i class="ri-gradienter-line" style="color: #ffa76e;"></i>
              <h3><a href="">Eiusmod Tempor</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box">
              <i class="ri-file-list-3-line" style="color: #11dbcf;"></i>
              <h3><a href="">Midela Teren</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box">
              <i class="ri-price-tag-2-line" style="color: #4233ff;"></i>
              <h3><a href="">Pira Neve</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box">
              <i class="ri-anchor-line" style="color: #b2904f;"></i>
              <h3><a href="">Dirada Pack</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box">
              <i class="ri-disc-line" style="color: #b20969;"></i>
              <h3><a href="">Moton Ideal</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box">
              <i class="ri-base-station-line" style="color: #ff5828;"></i>
              <h3><a href="">Verdo Park</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box">
              <i class="ri-fingerprint-line" style="color: #29cc61;"></i>
              <h3><a href="">Flavor Nivelanda</a></h3>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Features Section --> --}}

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials section-bg">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>ĐÁNH GIÁ TỪ KHÁCH HÀNG</h2>
          <p>MỘT SỐ LỜI ĐÁNH GIÁ TỪ KHÁCH HÀNG ĐÃ TRẢI NGHIỆM DỊCH VỤ CỦA TOYOTA - THẬP NHẤT PHONG</p>
        </div>

        {{-- <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-wrap">
                <div class="testimonial-item">
                  <img src="assets_site/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
                  <h3>Saul Goodman</h3>
                  <h4>Ceo &amp; Founder</h4>
                  <p>
                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                    Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.
                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                  </p>
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-wrap">
                <div class="testimonial-item">
                  <img src="assets_site/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
                  <h3>Sara Wilsson</h3>
                  <h4>Designer</h4>
                  <p>
                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                    Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.
                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                  </p>
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-wrap">
                <div class="testimonial-item">
                  <img src="assets_site/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
                  <h3>Jena Karlis</h3>
                  <h4>Store Owner</h4>
                  <p>
                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                    Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.
                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                  </p>
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-wrap">
                <div class="testimonial-item">
                  <img src="assets_site/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">
                  <h3>Matt Brandon</h3>
                  <h4>Freelancer</h4>
                  <p>
                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                    Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.
                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                  </p>
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-wrap">
                <div class="testimonial-item">
                  <img src="assets_site/img/testimonials/testimonials-5.jpg" class="testimonial-img" alt="">
                  <h3>John Larson</h3>
                  <h4>Entrepreneur</h4>
                  <p>
                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                    Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.
                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                  </p>
                </div>
              </div>
            </div><!-- End testimonial item -->

          </div>
          <div class="swiper-pagination"></div>
        </div> --}}

      </div>
    </section><!-- End Testimonials Section -->

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2 style="color: red">SẢN PHẨM HOT</h2>
          <p>Trong năm nay 2024 - Cùng chào đón các mẫu xe hot nhất năm nay nào</p>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="200">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="portfolio-flters">
              <li data-filter="*" class="filter-active">Tất cả</li>
              <li data-filter=".filter-app">TOYOTA CAMRY</li>
              <li data-filter=".filter-card">TOYOTA WIGO</li>
              <li data-filter=".filter-web">TOYOTA VIOS</li>
            </ul>
          </div>
        </div>

        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="400">

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
              <img src="assets_site/img/car/camry-1.png" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>TOYOTA CAMRY 2.0G</h4>
                <p>TOYOTA CAMRY</p>
                <div class="portfolio-links">
                  <a href="assets_site/img/car/camry-1.png" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Thông tin cơ bản:
                  <br>
                Kiểu dáng : Sedan
                <br>
                Số chỗ : 5
                <br>
                Hộp số : Tự động 8 cấp AT
                <br>
                Xuất xứ: Thái Lan
                <br>
                Nhiên liệu : Xăng + Điện"><i class="bx bx-plus"></i></a>
                  <a href="https://toyotavinhlongthapnhatphong.vn/san-pham/camry-2-0g/" title="More Details"><i class="bx bx-link"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <div class="portfolio-wrap">
              <img src="assets_site/img/car/vios3.png" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Toyota Vios 1.5G CVT</h4>
                <p>Toyota Vios 1.5G CVT</p>
                <div class="portfolio-links">
                  <a href="assets_site/img/car/vios3.png" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Thông tin cơ bản:
                    <br>
                  Kiểu dáng : Sedan
                  <br>
                  Số chỗ : 5
                  <br>
                  Hộp số : Số sàn 5 cấp
                  <br>
                  Xuất xứ: Lắp ráp trong nước
                  <br>
                  Nhiên liệu : Xăng"><i class="bx bx-plus"></i></a>
                  <a href="https://toyotavinhlongthapnhatphong.vn/san-pham/vios-1-5g-cvt/" title="More Details"><i class="bx bx-link"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
              <img src="assets_site/img/car/camry-2.png" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>TOYOTA CAMRY 2.5Q</h4>
                <p>TOYOTA CAMRY</p>
                <div class="portfolio-links">
                  <a href="assets_site/img/car/camry-2.png" data-gallery="portfolioGallery"
                  class="portfolio-lightbox"
                  title="Thông tin cơ bản:
                    <br>
                  Kiểu dáng : Sedan
                  <br>
                  Số chỗ : 5
                  <br>
                  Hộp số : Tự động 8 cấp AT
                  <br>
                  Xuất xứ: Thái Lan
                  <br>
                  Nhiên liệu : Xăng + Điện"><i class="bx bx-plus"></i></a>
                  <a href="https://toyotavinhlongthapnhatphong.vn/san-pham/camry-2-5q/" title="More Details"><i class="bx bx-link"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <div class="portfolio-wrap">
              <img src="assets_site/img/car/wigo1.png" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>TOYOTA WIGO E MT</h4>
                <p>TOYOTA WIGO E MT</p>
                <div class="portfolio-links">
                  <a href="assets_site/img/car/wigo1.png" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Thông tin cơ bản:
                    <br>
                  Kiểu dáng : Hatchback
                  <br>
                  Số chỗ : 5
                  <br>
                  Hộp số : Số sàn 5 cấp
                  <br>
                  Xuất xứ: Indonesia
                  <br>
                  Nhiên liệu : Xăng"><i class="bx bx-plus"></i></a>
                  <a href="https://toyotavinhlongthapnhatphong.vn/san-pham/wigo-e-mt/" title="More Details"><i class="bx bx-link"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <div class="portfolio-wrap">
              <img src="assets_site/img/car/wigo2.png" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Toyota Wigo G CVT</h4>
                <p>Toyota Wigo G CVT</p>
                <div class="portfolio-links">
                  <a href="assets_site/img/car/wigo2.png" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Thông tin cơ bản:
                  <br>
                Kiểu dáng : Hatchback
                <br>
                Số chỗ : 5
                <br>
                Hộp số : Số sàn 5 cấp
                <br>
                Xuất xứ: Indonesia
                <br>
                Nhiên liệu : Xăng"><i class="bx bx-plus"></i></a>
                  <a href="https://toyotavinhlongthapnhatphong.vn/san-pham/wigo-g-cvt/" title="More Details"><i class="bx bx-link"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <div class="portfolio-wrap">
              <img src="assets_site/img/car/vios3.png" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Toyota Vios 1.5E MT</h4>
                <p>Toyota Vios 1.5E MT</p>
                <div class="portfolio-links">
                  <a href="assets_site/img/car/vios3.png" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Thông tin cơ bản:
                <br>
                  Kiểu dáng : Sedan
                  <br>
                  Số chỗ : 5
                  <br>
                  Hộp số : Số sàn 5 cấp
                  <br>
                  Xuất xứ: Lắp ráp trong nước
                  <br>
                  Nhiên liệu : Xăng"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Portfolio Section -->

    <!-- ======= Team Section ======= -->
    <section id="team" class="team section-bg">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Nhân Viên Tiêu Biểu</h2>
          <p>Toyota xin tuyên dương những nhân viên có thành tích xuất sắc</p>
        </div>

        <div class="row">

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="100">
              <div class="member-img">
                <img src="uploads/default/avatar-1.jpg" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Nguyễn Văn A</h4>
                <span>Cố Vấn Dịch Vụ</span>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="200">
              <div class="member-img">
                <img src="uploads/default/avatar-1.jpg" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Nguyễn Văn A</h4>
                <span>Cố Vấn Dịch Vụ</span>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="300">
              <div class="member-img">
                <img src="uploads/default/avatar-1.jpg" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Nguyễn Văn A</h4>
                <span>Cố Vấn Dịch Vụ</span>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="400">
              <div class="member-img">
                <img src="uploads/default/avatar-1.jpg" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Nguyễn Văn A</h4>
                <span>Cố Vấn Dịch Vụ</span>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Team Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>LIÊN HỆ</h2>
        </div>

        <div class="row">

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="contact-about">
              <h3>TOYOTA - THẬP NHẤT PHONG VĨNH LONG</h3>
              <p>Sự hài lòng của quý khách à kết quả niềm vui của chúng tôi như một điều gì đó mà chính người kiến ​​trúc sư đã làm.</p>
              <div class="social-links">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="200">
            <div class="info">
              <div>
                <i class="ri-map-pin-line"></i>
                <p>11/2A QL1 Tân Bình, Tân Hưng, Long Hồ, Vĩnh Long.</p>
              </div>

              {{-- <div>
                <i class="ri-mail-send-line"></i>
                <p>info@example.com</p>
              </div> --}}

              <div>
                <i class="ri-phone-line"></i>
                <p>093.179.2899</p>
              </div>

            </div>
          </div>

          <div class="col-lg-5 col-md-12" data-aos="fade-up" data-aos-delay="300">
            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
              </div>
              <div class="form-group">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
              </div>
              <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="row d-flex align-items-center">
        <div class="col-lg-12 text-lg-left text-center">
          <div class="copyright">
            &copy; <strong>NHĐ</strong>. 2024
          </div>
          <div class="credits">
                <a href="">Nguyễn Đỉnh</a>
          </div>
        </div>
        {{-- <div class="col-lg-6">
          <nav class="footer-links text-lg-right text-center pt-2 pt-lg-0">
            <a href="#intro" class="scrollto">Home</a>
            <a href="#about" class="scrollto">About</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Use</a>
          </nav>
        </div> --}}
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets_site/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets_site/vendor/aos/aos.js"></script>
  <script src="assets_site/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets_site/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets_site/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets_site/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets_site/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets_site/js/main.js"></script>

</body>

</html>
