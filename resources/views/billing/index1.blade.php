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
                    @foreach ($plans as $plan )


                  <div class="col-12 col-md-4 col-lg-4">
                    <div class="pricing">
                      <div class="pricing-title">
                       {{$plan->name}}
                      </div>
                      <div class="pricing-padding">
                        <div class="pricing-price">
                          <div>IDR {{ number_format($plan->price) }} K</div>
                          <div>per bulan</div>
                        </div>
                        <div class="pricing-details">
                          <div class="pricing-item">
                            <div class="pricing-item-label"></div>
                          </div>
                        </div>
                      </div>
                      <div class="pricing-details">
                        <div class="pricing-item">
                          <div class="pricing-item-icon"><i class="fas fa-check"></i></div>
                          @foreach ($feature_plan as $f )
                            <div class="pricing-item-label">
                                @if ($plan->id == $f->plan_id)
                                {{$f->features->name}} <br>
                                {{$f->max_amount}}
                                @endif
                            </div>
                          @endforeach

                        </div>
                    </div>
                      <div class="pricing-cta">
                        @if (!is_null($currentPlan) && $plan->stripe_plan_id == $currentPlan->stripe_price)
                            <i> Paket Berlangganan Anda Saat ini ! </i>
                            <br/>
                                @if (!$currentPlan->onGracePeriod())
                                    <a href="{{ route('cancel') }}" onclick="return confirm('Are you sure?')">Batal Berlangganan</a>
                                @else
                                    Your subscription will end on {{ $currentPlan->ends_at->toDateString() }}
                                    <br />
                                    <a href="{{ route('resume') }}" >Lanjutkan Berlangganan</a>
                                @endif
                        @else
                            <a href="{{ route('checkout', $plan->id) }}">Langganan {{ $plan->name }}</a>
                        @endif
                      </div>
                    </div>
                  </div>


                  @endforeach
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
