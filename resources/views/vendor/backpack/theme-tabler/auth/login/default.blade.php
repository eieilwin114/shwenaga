@extends(backpack_view('layouts.auth'))

@section('content')
  <style>
    .navbar, .footer {
      display: none;
    }
  </style>
  <div class="page page-center my-5 py-5">
    <div class="container container-tight my-5 py-5">
      <div class="text-center mb-4 display-6 auth-logo-container">
        <img
          class="navbar-brand navbar-brand-autodark" style="max-height:85px;"
          src="{{url('/assets/img/logo-transparant.png')}}" alt="">
      </div>
      <div class="card card-md rounded-3 border-0 shadow p-0">
        <div class="card-body pt-0">
          @include(backpack_view('auth.login.inc.form'))
        </div>
      </div>
      @if (config('backpack.base.registration_open'))
        <div class="text-center text-muted mt-4">
          <a tabindex="6" href="{{ route('backpack.auth.register') }}">
            {{ trans('backpack::base.register') }}
          </a>
        </div>
      @endif
    </div>
  </div>
@endsection