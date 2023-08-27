@extends(backpack_view('blank'))

@php
  $defaultBreadcrumbs = [
    'Admin' => '/admin/dashboard',
    'users' => '/admin/users',
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
  label {
      margin: 10px 0px !important;
  }
</style>

@section('header')
    <section class="page-header p-3">
      <div clas="col text-center">
        <h3 class="page-title text-capitalize pb-0 mb-2">
          Create User
        </h3>
      </div>
    </section>
@endsection

@section('content')  
  {!! Form::open(['method' => 'POST','route' => ['users.store']]) !!}
      <!-- @if($errors->has('name'))
          <div class="alert alert-danger">
              {{ $errors->first('name') }}
          </div>
      @endif
      @if($errors->has('mobile'))
          <div class="alert alert-danger">
              {{ $errors->first('mobile') }}
          </div>
      @endif
      @if($errors->has('password'))
          <div class="alert alert-danger">
              {{ $errors->first('password') }}
          </div>
      @endif
      @if($errors->has('password_confirmation'))
          <div class="alert alert-danger">
              {{ $errors->first('password_confirmation') }}
          </div>
      @endif       -->
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
            <div class="form-group gy-2">    
                <label>Name</label>
                {!! Form::text('name', null, array('placeholder' => '','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
            <div class="form-group">    
                <label>Mobile</label>
                {!! Form::text('mobile', null, array('placeholder' => '','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12  mb-3">
            <div class="form-group">    
                <label>Password</label>
                <input type="password" name="password" autocomplete="off" class="form-control">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12  mb-3">
            <div class="form-group">    
                <label>Password Confirmation</label>
                <input type="password" name="password_confirmation" autocomplete="off" class="form-control">
                <!-- {!! Form::password('password_confirmation', null, array('placeholder' => '','class' => 'form-control','autocomplete'=>'off','id'=>'password_confirmation')) !!} -->
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12  mb-3">
            <div class="form-group">    
                <label>Shop</label>
                {!! Form::select('shop_id',$shops, null, array('placeholder' => '-','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12  mb-3">
            <div class="form-group">    
                <label>Roles</label><br>
                <div class="row">
                  @foreach($roles as $key=>$value)
                    <div class="col-4">
                        <label>
                            {!! Form::checkbox('role[]', $key, null) !!}
                            {{ $value }}
                        </label>
                      </div>
                  @endforeach
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 d-flex gap-1 mt-3">
            <button type="submit" class="btn btn-success">
              <span class="la la-save" role="presentation" aria-hidden="true"></span> &nbsp;
              Save
            </button>  
            <a class="btn btn-secondary text-decoration-none" href="{{ route('users') }}">
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
      // Add inline errors to the DOM
      @if (session()->get('errors'))

        window.errors = {!! json_encode(session()->get('errors')->getBags()) !!};

        $.each(errors, function(bag, errorMessages){
          $.each(errorMessages,  function (inputName, messages) {
            var normalizedProperty = inputName.split('.').map(function(item, index){
                    return index === 0 ? item : '['+item+']';
                }).join('');

            var field = $('[name="' + normalizedProperty + '[]"]').length ?
                        $('[name="' + normalizedProperty + '[]"]') :
                        $('[name="' + normalizedProperty + '"]'),
                        container = field.closest('.form-group');

            // iterate the inputs to add invalid classes to fields and red text to the field container.
            container.find('input, textarea, select').each(function() {
                let containerField = $(this);
                // add the invalid class to the field.
                containerField.addClass('is-invalid');
                // get field container
                let container = containerField.closest('.form-group');

                // TODO: `repeatable-group` should be deprecated in future version as a BC in favor of a more generic class `no-error-display`
                if(!container.hasClass('repeatable-group') && !container.hasClass('no-error-display')){
                  container.addClass('text-danger');
                }
            });

            $.each(messages, function(key, msg){
                // highlight the input that errored
                var row = $('<div class="invalid-feedback d-block">' + msg + '</div>');

                // TODO: `repeatable-group` should be deprecated in future version as a BC in favor of a more generic class `no-error-display`
                if(!container.hasClass('repeatable-group') && !container.hasClass('no-error-display')){
                  row.appendTo(container);
                }

                var tab_id = $(container).closest('[role="tabpanel"]').attr('id');
                $("#form_tabs [aria-controls="+tab_id+"]").addClass('text-danger');
            });
        });
      });
      @endif
     
  </script>
@endsection
