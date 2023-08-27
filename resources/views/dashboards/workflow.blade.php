@extends(backpack_view('blank'))

@section('content')
  <h1>
    Workflow dashboard
  </h1>

  <div class="row">
    <div class="col-12">
      @include('orders.partials.card-all-active')
    </div>
    <div class="col-3">
      @include('orders.partials.card-selected-orders')
    </div>
    <div class="col-3">
      @include('orders.partials.card-selected-orders')
    </div>
    <div class="col-3">
      @include('orders.partials.card-selected-orders')
    </div>
    <div class="col-3">
      @include('orders.partials.card-selected-orders')
    </div>
  </div>



@endsection