@extends(backpack_view('blank'))

@php
  $defaultBreadcrumbs = [
    'Admin' => '/admin/dashboard',
    'orders' => '/admin/orders',
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
          Order Detail
        </h3>
      </div>
    </section>
@endsection

@section('content')
      @if($errors->has('orders'))
          <div class="alert alert-danger">
              {{ $errors->first('orders') }}
          </div>
      @endif
      <div class="row mb-4">
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">    
                <strong>Order ID</strong> : {{$order->id}}
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">    
                <strong>Sale Person Name</strong> : {{$order->saleperson->name}}
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">    
                <strong>Mobile</strong> : {{$order->saleperson->mobile}}
            </div>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-vcenter card-table dataTable bg-white custom-table">
        <thead>
            <tr>
            <th>Item</th>
            <th>Qty</th>
            <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $orderitem)
                <tr>
                <td> {{$orderitem->name}}</td>
                <td> {{$orderitem->qty}}</td>
                <td> <a href="{{route('order-order-item-edit',$orderitem->id)}}">Edit</a></td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
            <th>Item</th>
            <th>Qty</th>
            <th>Action</th>
            </tr>
        </tfoot>
        </table>
    </div>
    <div class="mt-3">
         <a class="btn btn-secondary text-decoration-none" href="{{ route('orders') }}">
            <span class="la la-ban"></span> &nbsp;
            Cancel
        </a>
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
  </script>
@endsection
