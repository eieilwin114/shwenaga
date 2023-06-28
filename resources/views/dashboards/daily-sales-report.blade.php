@extends(backpack_view('blank'))

@section('content')


<div class="row">

  <div class="col-12">
    <h1 class="h2 pb-3">
      Daily Sales Report
    </h1>
  </div>


  <div class="col-8">
    <div class="card">
        @include('attendances.partials.card-table')
    </div>
  </div>


  <div class="col-4">
    <div class="card card-body p-4">
      <h2 class="h4 pb-2">
        Choosed a date
      </h2>

      <input class="d-none" type="hidden" name="flatpickr" id="flatpickr">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
      <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
      <script>
        // Otherwise, selectors are also supported
        flatpickr("#flatpickr", {
          maxDate: "20.6.2023",
          maxDate: "29.6.2023",
          inline: true,
          onChange: function(){
            document
              .getElementById('btn-submit-choose-date')
              .classList
              .remove('d-none');
          } 
        });
      </script>
      <a class="btn btn-primary d-none mt-3 w-100" href="#" role="button" id="btn-submit-choose-date">
        Browse choosed date
      </a>
    </div>
  </div>

</div>

@endsection



