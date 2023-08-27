@extends(backpack_view('blank'))

@php
  $defaultBreadcrumbs = [
    'Admin' => '/admin/dashboard',
    'users' => '/admin/users',
    'List' => false,
  ];

  // if breadcrumbs aren't defined in the CrudController, use the default breadcrumbs
  $breadcrumbs = $breadcrumbs ?? $defaultBreadcrumbs;
@endphp

@php  
  $division = session()->get(USER_DIVISION_FILTER);
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
        <h3 class="page-title text-capitalize pb-0 mb-2">
          Users
        </h3>
      </div>
    </section>
@endsection

@section('content')
  {!! Form::open(['method' => 'POST','route' => ['users.search']]) !!}
      <div class="row">        
        <div class="col-xs-3 col-sm-3 col-md-3">
            <div class="form-group">
                <strong>Region:</strong>
                {!! Form::select('division_id',$divisions, $division, array('placeholder' => '','class' => 'form-control')) !!}
            </div>
        </div>        
        <div class="col-xs-2 col-sm-2 col-md-2 my-3 d-flex gap-1">
            <button type="submit" class="btn btn-primary">Search</button>
            <a class="btn btn-primary" href="{{ route('users.search.reset') }}"> Reset</a>
        </div>
      </div>
    {!! Form::close() !!}
  <div class="table-responsive">
    <table class="table table-vcenter card-table dataTable bg-white custom-table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Mobile</th>
          <th>Role</th>
          <th>Shop</th>
          <th>Division</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->mobile}}</td>
            <?php
              $roles = '';
              foreach($user->roles as $role){
                if($roles != ''){
                  $roles .=  '/ ';
                }
                $roles .= $role->name;
              }
            ?>
            <td>{{$roles }}</td>
            <td>{{$user->shop_name}}</td>
            <td>{{$user->division}}</td>
            <td>
              <a class="btn btn-sm px-2 py-1 btn-outline-primary dropdown-toggle" href="#" data-toggle="dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Actions</a>
              <div class="dropdown-menu dropdown-menu-left" style="">
                <div class="nav-item dropdown">
                  <a href="{{ route('users.edit', $user->id) }}" class="dropdown-item">
                    <i class="la la-edit me-2 text-primary"></i> Edit
                  </a>                
		              <a href="javascript:void(0)" onclick="deleteEntry(this)" data-route="{{route('users.destroy',$user->id)}}" class="dropdown-item" data-button-type="delete">
                    <i class="la la-trash me-2 text-primary"></i> Delete
                  </a>
	              </div>
              </div> 
            </td>
          </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <th>Name</th>
          <th>Mobile</th>
          <th>Role</th>
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
                text: '<i class="la la-plus zoom"></i> Add User',
                attr: {class: 'btn btn-primary' },
                action: function ( e, dt, button, config ) {
                  window.location = '/admin/users/create';
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
    function deleteEntry(button) {
		// ask for confirmation before deleting an item
		// e.preventDefault();
      var route = $(button).attr('data-route');

      swal({
        title: "{!! trans('backpack::base.warning') !!}",
        text: "{!! trans('backpack::crud.delete_confirm') !!}",
        icon: "warning",
        buttons: ["{!! trans('backpack::crud.cancel') !!}", "{!! trans('backpack::crud.delete') !!}"],
        dangerMode: true,
      }).then((value) => {
        if (value) {
          $.ajax({
              url: route,
              type: 'DELETE',
              success: function(result) {
                if (result == 1) {
                  // Redraw the table
                  if (typeof crud != 'undefined' && typeof crud.table != 'undefined') {
                    // Move to previous page in case of deleting the only item in table
                    if(crud.table.rows().count() === 1) {
                      crud.table.page("previous");
                    }
                    crud.table.draw(false);
                  }
                  
                    // Show a success notification bubble
                  new Noty({
                      type: "success",
                      text: "{!! '<strong>'.trans('backpack::crud.delete_confirmation_title').'</strong><br>'.trans('backpack::crud.delete_confirmation_message') !!}"
                  }).show();
                  // Hide the modal, if any
                  $('.modal').modal('hide');
                  
                } else {
                    // if the result is an array, it means 
                    // we have notification bubbles to show
                    if (result instanceof Object) {
                      // trigger one or more bubble notifications 
                      Object.entries(result).forEach(function(entry, index) {
                        var type = entry[0];
                        entry[1].forEach(function(message, i) {
                        new Noty({
                            type: type,
                            text: message
                          }).show();
                        });
                      });
                    } else {// Show an error alert
                      swal({
                        title: "{!! trans('backpack::crud.delete_confirmation_not_title') !!}",
                              text: "{!! trans('backpack::crud.delete_confirmation_not_message') !!}",
                        icon: "error",
                        timer: 4000,
                        buttons: false,
                      });
                    }			          	  
                }
                location.reload();
              },
              error: function(result) {
                // Show an alert with the result
                swal({
                  title: "{!! trans('backpack::crud.delete_confirmation_not_title') !!}",
                      text: "{!! trans('backpack::crud.delete_confirmation_not_message') !!}",
                  icon: "error",
                  timer: 4000,
                  buttons: false,
                });
              }
          });
        }
      });
      }
	
  </script>
  
@endsection



