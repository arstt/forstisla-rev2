<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend/images/favicon.svg')}}" />

        <!-- ========================= CSS here ========================= -->
        <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}" />
        <link rel="stylesheet" href="{{asset('frontend/css/LineIcons.2.0.css')}}" />
        <link rel="stylesheet" href="{{asset('frontend/css/animate.css')}}" />
        <link rel="stylesheet" href="{{asset('frontend/css/tiny-slider.css')}}" />
        <link rel="stylesheet" href="{{asset('frontend/css/glightbox.min.css')}}" />
        <link rel="stylesheet" href="{{asset('frontend/css/main.css')}}" />

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    </head>
    <body>

        <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- /End Preloader -->


    <!-- Start Header Area -->
    <header class="header navbar-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="nav-inner">
                        <!-- Start Navbar -->
                        <nav class="navbar navbar-expand-lg">
                            <button class="navbar-toggler mobile-menu-btn" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                <ul id="nav" class="navbar-nav ms-auto">
                                    <li class="nav-item">
                                        <a href="#home" class="page-scroll active"
                                            aria-label="Toggle navigation">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#features" class="page-scroll"
                                            aria-label="Toggle navigation">Features</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#pricing" class="page-scroll"
                                            aria-label="Toggle navigation">Pricing</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="javascript:void(0)" aria-label="Toggle navigation">Contact</a>
                                    </li>
                                </ul>
                            </div> <!-- navbar collapse -->
                            <div class="button add-list-button">

                                @if (Route::has('login'))
                                    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="btn">Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="btn">Login</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="ml-4 btn">Register</a>
                                @endif
                            @endif
                        </div>
                            @endif
                            </div>
                        </nav>
                        <!-- End Navbar -->
                    </div>
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </header>
    <!-- End Header Area -->

    <!-- Start Hero Area -->
    <section id="home" class="hero-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-12 col-12">
                    <div class="hero-content">
                        <h1 class="wow fadeInLeft" data-wow-delay=".4s">Solusi Cerdar Penentu Keputusan Kredit </h1>
                        <p class="wow fadeInLeft" data-wow-delay=".6s">Kami adalah agensi yang membantu instansi keuangan untuk mencapai hasil bisnis kredit mereka. Kami melihat teknologi sebagai alat untuk menciptakan hal-hal yang menakjubkan dan memudahkan kinerja.</p>
                        <div class="button wow fadeInLeft" data-wow-delay=".8s">
                            @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn">Memulai</a>
                                @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-12 col-12">
                    <div class="hero-image wow fadeInRight" data-wow-delay=".4s">
                        <img src="{{asset('frontend/images/hero/laptop.png')}}" alt="#"> <!-- insert images for landing -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Hero Area -->

    <!-- Start Features Area -->
    <section id="features" class="features section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h3 class="wow zoomIn" data-wow-delay=".2s">Features</h3>
                        <h2 class="wow fadeInUp" data-wow-delay=".4s">Pengalaman Anda Menjadi Baik Dan Lebih Baik Seiring Waktu.</h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s">.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Feature -->
                    <div class="single-feature wow fadeInUp" data-wow-delay=".2s">
                        <i class="lni lni-cloud-upload"></i>
                        <h3>Register to Use</h3>
                        <p>Tidak perlu memahami bahasa pemrograman yang sulit untuk menggunakannya, hanya perlu mendaftar anda dapat menggunakan fitur yang tersedia.</p>
                    </div>
                    <!-- End Single Feature -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Feature -->
                    <div class="single-feature wow fadeInUp" data-wow-delay=".4s">
                        <i class="lni lni-lock"></i>
                        <h3>Multi-tenants System</h3>
                        <p>Multi Tenant adalah arsitektur cloud computing yang memungkinkan customer dapat berbagi sumber daya komputasi. Data terisolasi dan tidak akan terlihat oleh penyewa lainnya.</p>
                    </div>
                    <!-- End Single Feature -->
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <!-- Start Single Feature -->
                    <div class="single-feature wow fadeInUp" data-wow-delay=".6s">
                        <i class="lni lni-reload"></i>
                        <h3>Simple and Friendly</h3>
                        <p>tidak mengharuskan user untuk belajar terlebih dahulu bagaimana cara memakainya.
                            Karena semua perangkat khususnya pada teknologi informasi sudah mudah digunakan</p>
                    </div>
                    <!-- End Single Feature -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Features Area -->

    <!-- Start Pricing Table Area -->
    <section id="pricing" class="pricing-table section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h3 class="wow zoomIn" data-wow-delay=".2s">pricing</h3>
                        <h2 class="wow fadeInUp" data-wow-delay=".4s">Temukan solusi yang tepat untuk instansi Anda</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Single Table -->
                    <div class="single-table wow fadeInUp" data-wow-delay=".4s">
                        <!-- Table Head -->
                        <div class="table-head">
                            <h4 class="title">Broze</h4>
                            <div class="price">
                                <h2 class="amount">IDR 190 K<span class="duration">/bln</span></h2>
                            </div>
                            <div class="button">
                                @if (Route::has('login'))
                                <a href="{{ route('billing') }}" class="btn">Beli Broze Plan</a>
                                @else
                                <a href="{{ route('register') }}" class="btn">Beli Broze Plan</a>
                                @endif
                            </div>
                        </div>
                        <!-- End Table Head -->

                        <!-- Start Table Content -->
                        <div class="table-content">
                            <h4 class="middle-title">Untuk Kebutuhan</h4>
                            <!-- Table List -->
                            <ul class="table-list">
                                <li><i class="lni lni-checkmark-circle"></i> 10 Nasabah</li>
                                <li><i class="lni lni-checkmark-circle"></i> 10 Analisa</li>
                            </ul>
                            <!-- End Table List -->
                        </div>
                        <!-- End Table Content -->
                    </div>
                    <!-- End Single Table-->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Single Table -->
                    <div class="single-table wow fadeInUp" data-wow-delay=".6s">
                        <!-- Table Head -->
                        <div class="table-head">
                            <h4 class="title">Silver</h4>
                            <div class="price">
                                <h2 class="amount">IDR 290 K<span class="duration">/bln</span></h2>
                            </div>
                            <div class="button">
                                @if (Route::has('login'))
                                <a href="{{ route('billing') }}" class="btn">Beli Silver Plan</a>
                                @else
                                <a href="{{ route('register') }}" class="btn">Beli Silver Plan</a>
                                @endif
                            </div>
                        </div>
                        <!-- End Table Head -->

                        <!-- Start Table Content -->
                        <div class="table-content">
                            <h4 class="middle-title">Untuk Kebutuhan</h4>
                            <!-- Table List -->
                            <ul class="table-list">
                                <ul class="table-list">
                                    <li><i class="lni lni-checkmark-circle"></i> 1000 Nasabah</li>
                                    <li><i class="lni lni-checkmark-circle"></i> 1000 Analisa</li>
                                </ul>
                            </ul>
                            <!-- End Table List -->
                        </div>
                        <!-- End Table Content -->
                    </div>
                    <!-- End Single Table-->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Single Table -->
                    <div class="single-table wow fadeInUp" data-wow-delay=".8s">
                        <!-- Table Head -->
                        <div class="table-head">
                            <h4 class="title">Gold</h4>
                            <div class="price">
                                <h2 class="amount">IDR 399 K<span class="duration">/bln</span></h2>
                            </div>
                            <div class="button">
                                @if (Route::has('login'))
                                <a href="{{ route('billing') }}" class="btn">Beli Gold Plan</a>
                                @else
                                <a href="{{ route('register') }}" class="btn">Beli Gold Plan</a>
                                @endif
                            </div>
                        </div>
                        <!-- End Table Head -->
                        <!-- Start Table Content -->
                        <div class="table-content">
                            <h4 class="middle-title">Untuk Kebutuhan</h4>
                            <!-- Table List -->
                            <ul class="table-list">
                                <ul class="table-list">
                                    <li><i class="lni lni-checkmark-circle"></i> Unlimited Nasabah</li>
                                    <li><i class="lni lni-checkmark-circle"></i> Unlimited Analisa</li>
                                </ul>
                            </ul>
                            <!-- End Table List -->
                        </div>
                        <!-- End Table Content -->
                    </div>
                    <!-- End Single Table-->
                </div>
            </div>
        </div>
    </section>
    <!--/ End Pricing Table Area -->

    <!-- Start Call To Action Area -->
    <section class="section call-action">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 col-md-12 col-12">
                    <div class="cta-content">
                        <h2 class="wow fadeInUp" data-wow-delay=".2s">Learn from yesterday, live for today, hope for tomorrow.
                        </h2>
                        <p class="wow fadeInUp" data-wow-delay=".4s">- Albert Einsten</p>
                        <div class="button wow fadeInUp" data-wow-delay=".6s">
                            @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn">Memulai dari Sekarang</a>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Call To Action Area -->


    <!-- ========================= scroll-top ========================= -->
    <a href="#" class="scroll-top">
        <i class="lni lni-chevron-up"></i>
    </a>




    <!-- javascript -->
    <script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('frontend/js/wow.min.js')}}"></script>
    <script src="{{asset('frontend/js/tiny-slider.js')}}"></script>
    <script src="{{asset('frontend/js/glightbox.min.js')}}"></script>
    <script src="{{asset('frontend/js/count-up.min.js')}}"></script>
    <script src="{{asset('frontend/js/main.js')}}"></script>

    <script type="text/javascript">
        //====== counter up
        var cu = new counterUp({
        start: 0,
        duration: 2000,
        intvalues: true,
        interval: 100,
        append: " ",
    });
        cu.start();
    </script>
    </body>
</html>
