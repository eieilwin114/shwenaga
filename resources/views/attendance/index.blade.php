@extends(backpack_view('blank'))

@php
  $defaultBreadcrumbs = [
    'Admin' => '/admin/dashboard',
    'attendance' => '/admin/attendance',
    'List' => false,
  ];

  // if breadcrumbs aren't defined in the CrudController, use the default breadcrumbs
  $breadcrumbs = $breadcrumbs ?? $defaultBreadcrumbs;
@endphp

<style>
  div.dataTables_wrapper div.dataTables_filter input {
    margin-right: 4px;
  }
  #DataTables_Table_0_info {
    text-transform: uppercase;
    font-size: .625rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: .04em;
    line-height: 1rem;
    color: #616876;
    padding-left: 7px;
  }

  .dataTables_wrapper .bottom {
    display: flex;
    justify-content: space-between;
    background: white;
    padding: 14px;
  }

  table.dataTable.custom-table{
    margin-bottom: 0px!important;
  }

  .dataTables_filter {
    margin-bottom: 16px;
  }

  .paginate_button.previous,
  .paginate_button.next {
    color: #c8d3e1;
  }

  .paginate_button.current{
    min-width: 1.75rem;
    border-radius: 4px;
    color: #fff;
    background-color: #206bc4;
    padding: 5px 12px;
    margin: 0 5px;
  }
</style>

@section('header')
    <section class="page-header px-3">
      <div clas="col">
        <h3 class="page-title text-capitalize pb-0 mb-2p">
          Attendance Report
        </h3>
      </div>
    </section>
@endsection
@php
  $from_date = session()->get(AT_FROMDATE_FILTER);
  $to_date = session()->get(AT_TODATE_FILTER);
  $division= session()->get(AT_DIVISION_FILTER);
  $shop = session()->get(AT_SHOP_FILTER);
  $name = session()->get(AT_NAME_FILTER);
@endphp

@section('content')
  {!! Form::open(['method' => 'POST','route' => ['attendance.search']]) !!}
    <div class="row">
      <div class="col-xs-3 col-sm-3 col-md-3">
          <div class="form-group">
              <strong>From Date:</strong>
              {!! Form::date('from_date', $from_date, array('placeholder' => $from_date,'class' => 'form-control date-formatter')) !!}
          </div>
      </div>
      <div class="col-xs-3 col-sm-3 col-md-3">
          <div class="form-group">
              <strong>To Date:</strong>
              {!! Form::date('to_date', $to_date, array('placeholder' => $to_date,'class' => 'form-control date-formatter')) !!}
          </div>
      </div>
      <div class="col-xs-3 col-sm-3 col-md-3">
          <div class="form-group">
              <strong>Region:</strong>
              {!! Form::select('division_id', $divisions, $division, array('placeholder' => '','class' => 'form-control')) !!}
          </div>
      </div>
      <div class="col-xs-3 col-sm-3 col-md-3">
          <div class="form-group">
              <strong>Shop:</strong>
              {!! Form::select('shop_id', $shops, $shop, array('placeholder' => '','class' => 'form-control','id'=>'shop',)) !!}
          </div>
      </div>
      <div class="col-xs-3 col-sm-3 col-md-3">
          <div class="form-group">
              <strong>Name:</strong>
              {!! Form::select('name', $sale_persons, $name ,array('placeholder' => '','class' => 'form-control','id'=>'name')) !!}
          </div>
      </div>
      <div class="col-xs-2 col-sm-2 col-md-2 my-3 d-flex gap-1">
          <button type="submit" class="btn btn-primary">Search</button>
          <a class="btn btn-primary" href="{{ route('attendance.search.reset') }}"> Reset</a>
          <a class="btn btn-primary" href="{{ route('attendances.export') }}">Export</a>
      </div>
    </div>
  {!! Form::close() !!}

  <div class="table-responsive">
    <table class="table table-vcenter card-table dataTable bg-white custom-table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Date</th>
          <th>Region</th>
          <th>Shop</th>
          <th>Check In Time</th>
          <th>Check In Position</th>
          <th>Check Out Time</th>
          <th>Check Out Position</th>
          <th>Note</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($attendances as $attendance)
            <tr>
            <td> {{$attendance->user_name}}</td>
            <td> {{date('d-m-y',strtotime($attendance->created_at))}}</td>
            <td> {{ $attendance->division }}</td>
            <td> {{$attendance->shop_name}}</td>
            <td> {{($attendance->check_in_at != null) ? date('g:i A', strtotime($attendance->check_in_at)) : ''}} </td>
            <td> {{json_encode($attendance->check_in_position)}}</td>
            <td> {{($attendance->check_out_at != null) ? date('g:i A', strtotime($attendance->check_out_at)) : '' }}</td>
            <td> {{json_encode($attendance->check_out_position)}}</td>
            <td> {{$attendance->notes}} </td>
            </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <th>Name</th>
          <th>Date</th>
          <th>Region</th>
          <th>Shop</th>
          <th>Check In Time</th>
          <th>Check In Position</th>
          <th>Check Out Time</th>
          <th>Check Out Position</th>
          <th>Note</th>
        </tr>
      </tfoot>
    </table>
  </div>
@endsection

@section('after_styles')
  @basset('https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css')
  @basset('https://cdn.datatables.net/fixedheader/3.3.1/css/fixedHeader.dataTables.min.css')
  @basset('https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('after_scripts')
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="{{asset('main.js')}}"></script>
  <script>
      $(".dataTable").DataTable({
          lengthChange: false, // Disable "Show entries"
          searching: true,
          language: {
          search: '',
          searchPlaceholder: 'Search...'
          },
          pagingType: 'simple_numbers', // Choose from 'simple', 'simple_numbers', 'full', 'full_numbers'
          lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
          pageLength: 10,
          dom: '<"top"if>rt<"bottom"lp><"clear">',
          lengthChange: true,
          initComplete: function () {
            var api = this.api();
            $('.entries-per-page').html('Entries per page: <input type="number" min="1" max="100" value="' + api.page.len() + '">');
            $('.entries-per-page input').on('change', function () {
              var val = $(this).val();
              api.page.len(val).draw();
            });
          },

      });

      $('.dataTables_filter input[type="search"]').addClass('form-control');

      // $(".date-formatter").flatpickr({
      //   dateFormat: "d-m-y"
      // });
      $(document).ready(function () {
        $('.date-formatter').datetimepicker({
          format: 'DD/MM/YYYY',
          locale: 'en'
        });
      });
  </script>
@endsection



