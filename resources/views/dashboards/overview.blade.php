@extends(backpack_view('blank'))

@section('content')
  @if (env('APP_ENV') == 'development')
    @include('dashboards.partials.section-daily-sale-report')
    @include('dashboards.partials.section-workflow-dashboard')
    @include('dashboards.partials.section-workflow-manager')
    @include('dashboards.partials.section-docs')
  @endif
@endsection