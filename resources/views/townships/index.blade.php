@extends(backpack_view('blank'))

@php
  $defaultBreadcrumbs = [
    'Admin' => '/admin/dashboard',
    'township' => '/admin/township',
    'List' => false,
  ];

  // if breadcrumbs aren't defined in the CrudController, use the default breadcrumbs
  $breadcrumbs = $breadcrumbs ?? $defaultBreadcrumbs;
@endphp
@php
  $division = session()->get(TOWNSHIP_DIVISION_FILTER);
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

  .dt-buttons{
    float :left;
  }
</style>

@section('header')
    <section class="page-header px-3">
      <div clas="col">
        <h3 class="page-title text-capitalize pb-0 mb-2p">
          Townships
        </h3>
      </div>
    </section>
@endsection


@section('content')
  {!! Form::open(['method' => 'POST','route' => ['township.search']]) !!}
      <div class="row">        
        <div class="col-xs-3 col-sm-3 col-md-3">
            <div class="form-group">
                <strong>Region:</strong>
                {!! Form::select('division_id',$divisions, $division, array('placeholder' => '','class' => 'form-control','id'=>'division')) !!}
            </div>
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2 my-3 d-flex gap-1">
            <button type="submit" class="btn btn-primary">Search</button>
            <a class="btn btn-primary" href="{{ route('township.search.reset') }}"> Reset</a>
        </div>
      </div>
    {!! Form::close() !!}
  <div class="table-responsive">
    <table class="table table-vcenter card-table dataTable bg-white custom-table">
      <thead>
        <tr>
          <th>Township</th>
          <th>Region</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($townships as $township)
            <tr>
                <td> {{$township->township}}</td>            
                <td> {{isset($divisions[$township->division->id]) ? $divisions[$township->division->id] : '' }}</td>            
                <td> <a href="{{route('township.edit',$township->id)}}">Edit</a></td>            
            </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <th>Township</th>
          <th>Region</th>
          <th>Action</th>
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
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
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
          dom: '<"top"iBf>rt<"bottom"lp><"clear">',
          buttons: [
              {
                text: '<i class="la la-plus zoom"></i> Add Township',
                attr: {class: 'btn btn-primary' },
                action: function ( e, dt, button, config ) {
                  window.location = '/admin/township/create';
                }      
              }
          ],
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



