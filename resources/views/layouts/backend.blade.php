<!DOCTYPE html>
<html lang="lang=" {{ str_replace('_', '-' , app()->getLocale()) }}"">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend/images/favicon.svg')}}" />

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('stisla/modules/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('stisla/modules/fontawesome/css/all.min.css') }}">
  <!-- Plugins -->
  <link rel="stylesheet" href="{{ asset('stisla/modules/bootstrap-social/bootstrap-social.css') }}">
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('stisla/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('stisla/css/components.css') }}">
  <!-- Page Specific CSS File -->
  @yield('css')
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <x-navbar />
      <x-sidebar />
      <div class="main-content">
        <section class="section">
            @if (auth()->check() && auth()->user()->trial_ends_at)
                <div class="alert alert-info text-center">Anda Memiliki {{ now()->diffInDays(auth()->user()->trial_ends_at) }} hari tersisa untuk free trial.
                <a href="{{ route('billing') }}">Pilih Paket Berlangganan</a> kapan saja.</div>
            @endif
          @yield('content')
        </section>
      </div>
    </div>
  </div>

  <script src="{{ asset('dist/jquery.min.js') }}"></script>
  <script src="{{ asset('dist/adminlte.js') }}"></script>
  <script src="{{ asset('dist/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('dist/datatables.min.js') }}"></script>
  <!-- General JS Scripts -->
  {{-- <script src="{{ asset('stisla/modules/jquery.min.js') }}"></script> --}}
  <script src="{{ asset('stisla/modules/popper.js') }}"></script>
  <script src="{{ asset('stisla/modules/tooltip.js') }}"></script>
  <script src="{{ asset('stisla/modules/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('stisla/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
  <script src="{{ asset('stisla/modules/moment.min.js') }}"></script>
  <script src="{{ asset('stisla/js/stisla.js') }}"></script>
  <script src="{{ asset('dist/simple.money.format.js') }}"></script>

  <!-- Plugins -->
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="{{ asset('stisla/js/scripts.js') }}"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ asset('stisla/js/custom.js') }}"></script>


  <script>
    $('.number').simpleMoneyFormat()
    $('.number').keydown(function(e){
      const keyCode = e.keyCode
      const excludedKeys = [8, 37, 39, 46];
      if (!((keyCode >= 48 && keyCode <= 57) || (keyCode >= 96 && keyCode <= 105) || (excludedKeys.includes(keyCode)))) {
        e.preventDefault();
      }
    })
  </script>

  @stack('scripts')
</body>

</html>
