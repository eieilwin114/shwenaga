@extends(backpack_view('blank'))

@section('content')


<div class="row">

  <div class="col-12">
    <h1 class="h2 pb-3">
        Employee Monthly Performance Report
    </h1>
  </div>


  <div class="col-8">
    <div class="card">
        @include('attendances.partials.card-table')
    </div>
  </div>


  <div class="col-4">
    <div class="card card-body">
      <h2 class="h4 pb-2">
        Choosed a month
      </h2>

      <!-- Hover added -->
      <div class="list-group">
        <a href="#" class="list-group-item list-group-item-action">
            Jun 2023
        </a>
        <a href="#" class="list-group-item list-group-item-action">
            July 2023
        </a>
        <a href="#" class="list-group-item list-group-item-action">
            Aug 2023
        </a>
      </div>
    </div>
  </div>

</div>

@endsection



