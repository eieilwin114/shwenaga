@extends(backpack_view('blank'))
@section('content')
  <style>
    .welcome-box {
      margin-top: 150px;
    }
    .welcome-text {
      font-size: 70px;
    }
  </style>
  <div class="d-flex justify-content-center align-items-center w-100 flex-column welcome-box">
    <p class="mb-1 welcome-text">👋Welcome!</p>
    <h2 class="fw-boder">Myanma Shwe Nagar.</h2>
  </div>
  @if (env('APP_ENV') == 'development')
    @include('dashboards.partials.section-daily-sale-report')
    @include('dashboards.partials.section-workflow-dashboard')
    @include('dashboards.partials.section-workflow-manager')
    @include('dashboards.partials.section-docs')
  @endif
@endsection