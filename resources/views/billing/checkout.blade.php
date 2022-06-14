@extends('layouts.backend')

@section('title', 'Langganan')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>{{ 'Langganan' }}</h4>
    </div>
        <div class="card-body">
            <div class="section-body">
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <h2 class="section-title">Berlangganan Untuk {{ $plan->name }}</h2>

                <form action="{{ route('checkout.process') }}" method="POST" id="checkout-form">

                <div class="row">
                    <div class="col-md-4">
                        Nama Lembaga:
                        <br />
                        <input type="text" name="company_name" class="form-control" required />
                    </div>
                    <div class="col-md-4">
                       Alamat 1:
                        <br />
                        <input type="text" name="address_line_1" class="form-control" required />
                    </div>
                    <div class="col-md-4">
                        Alamat 2 (optional):
                        <br />
                        <input type="text" name="address_line_2" class="form-control" />
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        Negara:
                        <br />
                        <select name="country_id" class="form-control">
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        Kab/Kota:
                        <br />
                        <input type="text" name="city" class="form-control" required />
                    </div>
                    <div class="col-md-4">
                        Kode Pos:
                        <br />
                        <input type="text" name="postcode" class="form-control" />
                    </div>
                </div>

                <br />
                <div class="row">
                    <div class="col-md-6">
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                <div class="row">
                    <div class="col-md-6">
                            @csrf
                            <input type="hidden" name="billing_plan_id" value="{{ $plan->id }}" />
                            <input type="hidden" name="payment-method" id="payment-method" value="" />

                            <input id="card-holder-name" type="text" placeholder="Card holder name" class="form-control">

                            <!-- Stripe Elements Placeholder -->
                            <div id="card-element"></div>

                            <br />

                            <button id="card-button" class="btn btn-primary">
                                Pay IDR {{ number_format($plan->price) }} K
                            </button>


                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"> </script>

<script src="https://js.stripe.com/v3/"></script>
<script>
  $( document ).ready(function() {
    let stripe = Stripe("{{ env('STRIPE_KEY') }}")
    let elements = stripe.elements()
    let style = {
      base: {
        color: '#32325d',
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder': {
          color: '#aab7c4'
        }
      },
      invalid: {
        color: '#fa755a',
        iconColor: '#fa755a'
      }
    }
    let card = elements.create('card', {style: style})
    card.mount('#card-element')
    let paymentMethod = null
    $('#checkout-form').on('submit', function (e) {
      if (paymentMethod) {
        return true
      }
      stripe.confirmCardSetup(
        "{{ $intent->client_secret }}",
        {
          payment_method: {
            card: card,
            billing_details: {name: $('#card-holder-name').val()}
          }
        }
      ).then(function (result) {
        if (result.error) {
          console.log(result)
          alert('error')
        } else {
          paymentMethod = result.setupIntent.payment_method
          $('#payment-method').val(paymentMethod)
          $('#checkout-form').submit()
        }
      })
      return false
    })
  });
    </script>
@endpush

@section('css')
    <style>
        .StripeElement {
            box-sizing: border-box;
            height: 40px;
            padding: 10px 12px;
            border: 1px solid transparent;
            border-radius: 4px;
            background-color: white;
            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }
        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }
        .StripeElement--invalid {
            border-color: #fa755a;
        }
        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }
    </style>
@endsection
