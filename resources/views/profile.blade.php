@extends('layouts.backend')

@section('title', 'Profile')

@section('content')
<x-section-header heading="Profile" breadcrumb="profile" />
<x-section-sub-header title="Hi! {{ Str::words(auth()->user()->name, 1, '') }}"
  lead="Change information about yourself on this page." />

<div class="row mt-sm-4">
  <div class="col-12 col-md-12 col-lg-5">
    <div class="card profile-widget">
      <div class="profile-widget-header">
        <img alt="image" src="{{ auth()->user()->avatar_url }}" class="rounded-circle profile-widget-picture">
        <div class="profile-widget-items">
          <div class="profile-widget-item">
            <div class="profile-widget-item-label"></div>
            <div class="profile-widget-item-value"></div>
          </div>
          <div class="profile-widget-item">
            <div class="profile-widget-item-label"></div>
            <div class="profile-widget-item-value"></div>
          </div>
          <div class="profile-widget-item">
            <div class="profile-widget-item-label"></div>
            <div class="profile-widget-item-value"></div>
          </div>
        </div>
      </div>
      <div class="profile-widget-description">
        <div class="profile-widget-name">{{ auth()->user()->name }} <div class="text-muted d-inline font-weight-normal">
            <div class="slash"></div>
            {{ auth()->user()->company_name }}
          </div>
        </div>
      </div>

    </div>
    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::twoFactorAuthentication()))
    @include('profile.two-factor-authentication-form')
    @endif
  </div>
  <div class="col-12 col-md-12 col-lg-7">
    @if (session('status'))
    <div class="alert alert-primary alert-dismissible show fade">
      <div class="alert-body">
        <button class="close" data-dismiss="alert">
          <span>&times;</span>
        </button>
        @if (session('status')=='profile-information-updated')
        Profile has been updated.
        @endif
        @if (session('status')=='password-updated')
        Password has been updated.
        @endif
        @if (session('status')=='two-factor-authentication-disabled')
        Two factor authentication disabled.
        @endif
        @if (session('status')=='two-factor-authentication-enabled')
        Two factor authentication enabled.
        @endif
        @if (session('status')=='recovery-codes-generated')
        Recovery codes generated.
        @endif
      </div>
    </div>
    @endif

    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updateProfileInformation()))
    @include('profile.update-profile-information-form')
    @endif

    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
    @include('profile.update-password-form')
    @endif
  </div>
</div>
@endsection
