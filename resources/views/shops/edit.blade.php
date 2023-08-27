@extends(backpack_view('blank'))

@php
  $defaultBreadcrumbs = [
    'Admin' => '/admin/dashboard',
    'shop' => '/admin/shop',
    'Create' => false,
  ];

  // if breadcrumbs aren't defined in the CrudController, use the default breadcrumbs
  $breadcrumbs = $breadcrumbs ?? $defaultBreadcrumbs;
@endphp

@php
  $from_date = session()->get(SR_FROMDATE_FILTER);
  $to_date = session()->get(SR_TODATE_FILTER);
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
  .text-right{
    text-align:right;
  }
</style>

@section('header')
    <section class="page-header p-3">
      <div clas="col text-center">
        <h3 class="page-title text-capitalize pb-0 mb-2">
          Create Shop
        </h3>
      </div>
    </section>
@endsection

@section('content')  
  {!! Form::model($shop,['method' => 'PATCH','route' => ['shop.update',$shop->id]]) !!}
      @if($errors->has('shop'))
          <div class="alert alert-danger">
              {{ $errors->first('shop') }}
          </div>
      @endif
      <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">    
                <strong>Shop</strong>
                {!! Form::text('name', null, array('placeholder' => 'shop','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">    
                <strong>Latitude</strong>
                {!! Form::text('lat', null, array('placeholder' => 'lat','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">    
                <strong>Longitude</strong>
                {!! Form::text('long', null, array('placeholder' => 'long','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">    
                <strong>Division</strong>
                {!! Form::select('division_id',$divisions, null, array('placeholder' => 'Select Division','class' => 'form-control','id'=>'division_shop')) !!}
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">    
                <strong>Township</strong>
                {!! Form::select('township_id',$townships, null, array('placeholder' => 'Select Township','class' => 'form-control','id'=>'township_shop')) !!}
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">    
                <strong>Status</strong>
                {!! Form::select('status',$status, null, array('placeholder' => 'Select Status','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 d-flex gap-1 mt-3">
            <button type="submit" class="btn btn-success">
              <span class="la la-save" role="presentation" aria-hidden="true"></span> &nbsp;
              Save
            </button>  
            <a class="btn btn-secondary text-decoration-none" href="{{ route('shop.index') }}">
              <span class="la la-ban"></span> &nbsp;
              Cancel
            </a>          
        </div>
      </div>
  {!! Form::close() !!}
  
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
  </script>
@endsection
