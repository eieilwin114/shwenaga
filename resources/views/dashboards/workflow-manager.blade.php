@extends(backpack_view('blank'))

@section('content')

  @php
  $orderGroups = [
    'Active',
    'Approved',
    'Shipping',
    'Closure',
  ];
  @endphp
  <h1>
    Workflow manager
  </h1>
  <div class="row my-3 g-3">
    @foreach ($orderGroups as $orderGroup)
      <div class="col-6">
        <div class="card">
          <div class="h4 card-header p-2 m-0">
            {{$orderGroup}}
          </div>
          <div class="d-flex">
            <div class="overflow-y-scroll overflow-x-hidden" style="max-height: 260px">
              @include('orders.partials.list-group')
            </div>
            <div class="overflow-y-scroll overflow-x-hidden" style="max-height: 260px">
              @include('orders.partials.list-group')
            </div>
          </div>

        </div>
      </div>
    @endforeach
  </div>

@endsection