@extends('layouts.backend')

@section('title', 'Dashboard')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Dashboard</h4>
    </div>

    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="far fa-user"></i>
                </div>



                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Nasabah</h4>
                  </div>
                  <div class="card-body">
                    {{ $nasabah }}
                  </div>
                </div>


              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Analisa</h4>
                  </div>
                  <div class="card-body">
                    {{ $analisa }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Langganan</h4>
                  </div>
                  <div class="card-body">

                    @if (is_null($currentPlan))
                        Free Trial
                    @else
                        {{ $currentPlan->stripe_status }}
                    @endif

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="card">
            <div class="card-header">
              <h4>Informasi Mengenai Sistem</h4>
            </div>
            <div class="card-body">
              <div id="accordion">
                <div class="accordion">
                  <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-1" aria-expanded="true">
                    <h4>Navigasi & Kegunaan</h4>
                  </div>
                  <div class="accordion-body collapse show" id="panel-body-1" data-parent="#accordion">
                    <p class="mb-0"><b>Navigasi </b> - berada pada sebelah kiri, terdapat menu dashboar, nasabah, analisa, ranking Keputusan
                    langganan, dan profile. Setiap menu memiliki fungsi tersendiri yang dapat digunakan setelah anda berlangganan.
                    <br/>
                    Pada Dashboard anda dapat melihat total nasabah yang anda miliki, serta total analisa yang telah anda buat,
                    dan juga dapat melihat status berlangganan anda. Jika status Non Active anda harus melakukan langganan untuk dapat menggunakan Resource yang tersedia.
                    </p>
                  </div>
                </div>
                <div class="accordion">
                  <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-2">
                    <h4>Nasabah</h4>
                  </div>
                  <div class="accordion-body collapse" id="panel-body-2" data-parent="#accordion">
                    <p class="mb-0">* Layanan ini hanya dapat digunakan ketika anda sudah berlangganan</p>
                  </div>
                </div>
                <div class="accordion">
                  <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-3">
                    <h4>Analisa</h4>
                  </div>
                  <div class="accordion-body collapse" id="panel-body-3" data-parent="#accordion">
                    <p class="mb-0">* Layanan ini hanya dapat digunakan ketika anda sudah berlangganan</p>
                  </div>
                </div>
                <div class="accordion">
                    <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-4">
                      <h4>Ranking Keputusan</h4>
                    </div>
                    <div class="accordion-body collapse" id="panel-body-4" data-parent="#accordion">
                      <p class="mb-0">* Layanan ini hanya dapat digunakan ketika anda sudah berlangganan</p>
                    </div>
                </div>
                <div class="accordion">
                    <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-5">
                      <h4>Langganan</h4>
                    </div>
                    <div class="accordion-body collapse" id="panel-body-5" data-parent="#accordion">
                      <p class="mb-0">* Layanan ini hanya dapat digunakan ketika anda sudah berlangganan</p>
                    </div>
                </div>
                <div class="accordion">
                    <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-6">
                      <h4>Bug & Masalah</h4>
                    </div>
                    <div class="accordion-body collapse" id="panel-body-6" data-parent="#accordion">
                      <p class="mb-0">Jika terdapat bug dan masalah anda dapat menghubungi : admin@forstisla.com</p>
                    </div>
                </div>

              </div>
            </div>
    </div>
</div>
@endsection
