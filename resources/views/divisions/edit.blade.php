@extends(backpack_view('blank'))

@php
  $defaultBreadcrumbs = [
    'Admin' => '/admin/dashboard',
    'region' => '/admin/region',
    'Update' => false,
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
          Update Region
        </h3>
      </div>
    </section>
@endsection

@section('content')
  {!! Form::model($division,['method' => 'PATCH','route' => ['division.update',$division->id]]) !!}
      @if($errors->has('division'))
          <div class="alert alert-danger">
              {{ $errors->first('division') }}
          </div>
      @endif
      <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">    
                <strong>Region</strong>
                {!! Form::text('division', null, array('placeholder' => 'Division','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 d-flex gap-1 mt-3">
            <button type="submit" class="btn btn-success">
              <span class="la la-save" role="presentation" aria-hidden="true"></span> &nbsp;
              Save
            </button>  
            <a class="btn btn-secondary text-decoration-none" href="{{ route('division.index') }}">
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
  <script>
      
  </script>
@endsection
