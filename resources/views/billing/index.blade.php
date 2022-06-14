@extends('layouts.backend')

@section('title', 'Langganan')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>{{ 'Langganan' }}</h4>
    </div>
        <div class="card-body">
            <div class="section-body">
                <h2 class="section-title">Berlangganan</h2>

                @if (session('message'))
                    <div class="alert alert-info">{{ session('message') }}</div>



                    @endif

                @if (is_null($currentPlan))
                    You are now on Free Plan. Please choose plan to upgrade:
                    <br /><br />
                @endif

                <div class="row">
                    <div class="col-12 col-md-4 col-lg-4">
                        <div class="pricing pricing-highlight">
                          <div class="pricing-title">
                            Bronze Plan
                          </div>
                          <div class="pricing-padding">
                            <div class="pricing-price">
                              <div>IDR 190 K</div>
                              <div>/ Bulan</div>
                            </div>
                            <div class="pricing-details">
                              <div class="pricing-item">
                                <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                <div class="pricing-item-label">100 Nasabah</div>
                              </div>
                              <div class="pricing-item">
                                <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                <div class="pricing-item-label">100 Analisa</div>
                              </div>
                            </div>
                          </div>
                          <div class="pricing-cta">
                            <a href="#">Subscribe <i class="fas fa-arrow-right"></i></a>
                          </div>
                        </div>
                      </div>

                      <div class="col-12 col-md-4 col-lg-4">
                        <div class="pricing pricing-highlight">
                          <div class="pricing-title">
                            Silver Plan
                          </div>
                          <div class="pricing-padding">
                            <div class="pricing-price">
                              <div>IDR 290 K</div>
                              <div>/ Bulan</div>
                            </div>
                            <div class="pricing-details">
                              <div class="pricing-item">
                                <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                <div class="pricing-item-label">1.000 Nasabah</div>
                              </div>
                              <div class="pricing-item">
                                <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                <div class="pricing-item-label">1.000 Analisa</div>
                              </div>
                            </div>
                          </div>
                          <div class="pricing-cta">
                            <a href="#">Subscribe <i class="fas fa-arrow-right"></i></a>
                          </div>
                        </div>
                      </div>

                      <div class="col-12 col-md-4 col-lg-4">
                        <div class="pricing pricing-highlight">
                          <div class="pricing-title">
                            Gold Plan
                          </div>
                          <div class="pricing-padding">
                            <div class="pricing-price">
                              <div>IDR 399 K</div>
                              <div>/ Bulan</div>
                            </div>
                            <div class="pricing-details">
                              <div class="pricing-item">
                                <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                <div class="pricing-item-label">10.000 Nasabah</div>
                              </div>
                              <div class="pricing-item">
                                <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                                <div class="pricing-item-label">10.000 Analisa</div>
                              </div>
                            </div>
                          </div>
                          <div class="pricing-cta">
                            <a href="#">Subscribe <i class="fas fa-arrow-right"></i></a>
                          </div>
                        </div>
                      </div>


                </div>

                @if (!is_null($currentPlan))
                <br />
                    <div class="card">
                        <div class="section-body">
                            <h2 class="section-title">Payment Method</h2>

                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Brand</th>
                                        <th>Expires at</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($paymentMethods as $paymentMethod)
                                    <tr>
                                        <td>{{ $paymentMethod->card->brand }}</td>
                                        <td>{{ $paymentMethod->card->exp_month }} / {{ $paymentMethod->card->exp_year }}</td>
                                        <td>
                                            @if ($defaultPaymentMethod->id == $paymentMethod->id)
                                                default
                                            @else
                                                <a href="{{ route('payment-methods.markDefault', $paymentMethod->id) }}" class="btn btn-primary">Mark as Default</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <br />
                            <a href="{{ route('payment-method.create') }}" class="btn btn-primary">Tambah Metode Pembayaran</a>
                        </div>
                    </div>
                 @endif
                </div>

                 <br />

                 <br />
            <div class="card">
                <div class="card-header">
                    <h2 class="section-title">Payment History</h2>
                </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Payment Date</th>
                            <th>Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($payments as $payment)
                            <tr>
                                <td>{{ $payment->created_at }}</td>
                                <td>IDR {{ number_format($payment->total) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>
@endsection
