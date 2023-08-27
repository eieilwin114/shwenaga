@php
  $username = backpack_authentication_column();
@endphp


<h2 class="fs-2 text-center mt-4 mb-2">
  {{ trans('backpack::base.login') }}
</h2>


<form method="POST" action="/admin/login" autocomplete="off" novalidate="">
    @csrf
    @if ($username=="mobile")
      <div class="mb-3">
        <label class="form-label" for="{{ $username }}">
          {{ config('backpack.base.authentication_column_name') }}
        </label>
        <div class="input-group input-group-flat">
          <!-- <span 
            class="input-group-text bg-transparent" data-bs-toggle="tooltip" 
            data-bs-original-title="Myanmar phone number only"> -->
            <!-- <span class="flag flag-xs flag-country-mm"></span> -->
            <!-- <span class="link-secondary ms-2">
              +95
            </span> -->
          <!-- </span> id="mobile-input"-->
          
          <input 
            autofocus tabindex="2" type="text" name="{{ $username }}" 
            value="{{ old($username) }}" id="{{ $username }}" placeholder="09123456884"
            class="form-control {{ $errors->has($username) ? 'is-invalid' : '' }}">
        </div>
        @if ($errors->has($username))
          <div class="invalid-feedback">{{ $errors->first($username) }}</div>
        @endif
      </div>
    @else
      <div class="mb-3">
        <label class="form-label" for="{{ $username }}">
          {{ config('backpack.base.authentication_column_name') }}
        </label>
        <input 
          autofocus tabindex="1" type="text" name="{{ $username }}" 
          value="{{ old($username) }}" id="{{ $username }}" 
          class="form-control {{ $errors->has($username) ? 'is-invalid' : '' }}">
        @if ($errors->has($username))
          <div class="invalid-feedback">{{ $errors->first($username) }}</div>
        @endif
      </div>
    @endif

    <div class="mb-2">
      <label class="form-label" for="password">
        {{ trans('backpack::base.password') }}
      </label>
      <input tabindex="2" type="password" name="password" id="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" value="">
      @if ($errors->has('password'))
        <div class="invalid-feedback">{{ $errors->first('password') }}</div>
      @endif
    </div>



    <div class="d-flex justify-content-between align-items-center mb-2">
      <label class="form-check mb-0">
        <input tabindex="3" type="checkbox" class="form-check-input" checked>
        <span class="form-check-label">{{ trans('backpack::base.remember_me') }}</span>
      </label>
      @if (backpack_users_have_email() AND Route::has('backpack.auth.password.reset') )
        <div class="form-label-description">
          <a tabindex="4" href="{{ route('backpack.auth.password.reset') }}">
            {{ trans('backpack::base.forgot_your_password') }}
          </a>
        </div>
      @endif
    </div>


    <div class="form-footer mt-4">
      <button tabindex="5" type="submit" class="btn btn-primary w-100">
        {{ trans('backpack::base.login') }}
      </button>
    </div>


</form>


<script>
  window.addEventListener("DOMContentLoaded", (event) => {
    const elem = document.getElementById("mobile-input");
    elem.value = "9";
  });
</script>


<!-- @if (env('APP_DEBUG')) -->
  <!-- <div class="offcanvas offcanvas-bottom h-auto show" tabindex="-1" id="offcanvasBottom" aria-modal="true" role="dialog">
    <div class="offcanvas-body">
      <div class="container pb-5 px-5">
        <h1 class="display-4">
          Debug mode
        </h1>
        <p>
          🐞 
          Do you know you are in debug mode? 
          And <b>Magic login</b> is available here.
        </p>
        <p>
          <a type="button" class="btn btn-primary px-3" data-bs-toggle="modal" data-bs-target="#modal-small">
            Magic login
          </a>
        </p>
        <p class="text-body-tertiary fs-5">
          Debug mode is a feature in software applications that allows software testers 
          to identify and resolve issues or bugs within the software. It provides a more 
          detailed view of the software's internal workings, making it easier to understand 
          the program's behavior and pinpoint any problems that may occur during its execution.
          When running an application in debug mode, several key functionalities are typically 
          available to software testers. And here again <b>Magic Login</b> is alos included.
        </p>
      </div>
    </div>
  </div> -->
<!-- @endif -->










<div class="modal modal-blur fade" id="modal-small" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="card">
          <table class="table card-table table-vcenter">
            <thead>
              <tr>
                <th>Account</th>
                <th>Mobile</th>
                <th>Password</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach (Config::get('shwe-naga.magic-login') as $user)
                <tr>
                  <td>{{$user['name']}}</td>
                  <td>{{$user['mobile']}}</td>
                  <td>password</td>
                  <td class="text-end">
                    <a class="btn btn-primary btn-sm px-3" href="{{url('magic-login/')}}?email={{$user['email']}}">
                      Magic login
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>