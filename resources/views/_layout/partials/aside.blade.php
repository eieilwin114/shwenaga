@if (env('APP_ENV') == 'development')
  <!-- Users, Roles, Permissions -->
  <li class="nav-item dropdown">
    <a 
      class="nav-link dropdown-toggle" href="#navbar-help" 
      data-bs-toggle="dropdown" data-bs-auto-close="false" 
      role="button" aria-expanded="false">
        <span class="nav-link-icon d-md-none d-lg-inline-block">
          <span class="nav-link-icon d-md-none d-lg-inline-block">
            <i class="icon ti ti-home-2"></i>
          </span>
        </span>
        <span class="nav-link-title">
          Dashboard
        </span>
    </a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="{{backpack_url('dashboard')}}">
        Overview
      </a>
      <a class="dropdown-item" href="{{route('dashboards.workflow')}}">
        Workflow Dashboard
      </a>
      <a class="dropdown-item" href="{{route('dashboards.workflow-manager')}}">
        Workflow Manager
      </a>
      <a class="dropdown-item" href="{{route('dashboards.daily-sales-report')}}">
        Sales Report
      </a>
      <a class="dropdown-item" href="{{route('dashboards.monthly-performance-report')}}">
        Employee Performance
      </a>
      <a class="dropdown-item" href="{{route('dashboards.daily-attendances-report')}}">
        Employee Attendances
      </a>
    </div>
  </li>
@endif



<!-- Dashboard
<li class="nav-item">
  <a class="nav-link" href="/admin/dashboard">
    <span class="nav-link-icon d-md-none d-lg-inline-block">
      <i class="icon ti ti-home"></i>
    </span>
    <span class="nav-link-title">
      Dashboard
    </span>
  </a>
</li> -->


<!-- Products -->
<li class="nav-item">
  <a class="nav-link" href="{{ backpack_url('product') }}">
    <span class="nav-link-icon d-md-none d-lg-inline-block">
      <i class="icon ti ti-tag"></i>
    </span>
    <span class="nav-link-title">
      Products
    </span>
  </a>
</li>


<!-- Tags -->
<li class="nav-item">
  <a class="nav-link" href="{{ backpack_url('tag') }}">
    <span class="nav-link-icon d-md-none d-lg-inline-block">
      <i class="icon ti ti-box"></i>
    </span>
    <span class="nav-link-title">
      Tags
    </span>
  </a>
</li>




<!-- Orders
<li class="nav-item">
  <a class="nav-link" href="{{ backpack_url('order') }}">
    <span class="nav-link-icon d-md-none d-lg-inline-block">
      <i class="icon ti ti-box"></i>
    </span>
    <span class="nav-link-title">
      Orders
    </span>
  </a>
</li> -->

<li class="nav-item">
  <a class="nav-link" href="{{ backpack_url('order-item') }}">
    <span class="nav-link-icon d-md-none d-lg-inline-block">
      <i class="icon ti ti-box"></i>
    </span>
    <span class="nav-link-title">
      Sale Report
    </span>
  </a>
</li> 





<!-- Tags -->
{{-- <li class="nav-item">
  <a class="nav-link" href="{{ backpack_url('tag') }}">
    <span class="nav-link-icon d-md-none d-lg-inline-block">
      <i class="icon ti ti-box"></i>
    </span>
    <span class="nav-link-title">
      Appraisals
    </span>
  </a>
</li> --}}

<li class="nav-item">
  <a class="nav-link" href="{{ backpack_url('shop') }}">
    <span class="nav-link-icon d-md-none d-lg-inline-block">
      <i class="icon ti ti-box"></i>
    </span>
    <span class="nav-link-title">
      Shops
    </span>
  </a>
</li>



<!-- Users, Roles, Permissions -->
<li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle" href="#navbar-help" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false" >
    <span class="nav-link-icon d-md-none d-lg-inline-block"><i class="icon ti ti-users"></i>
    </span>
    <span class="nav-link-title">
      Authentication
    </span>
  </a>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="{{ backpack_url('user') }}">
      Users
    </a>
    <a class="dropdown-item" href="{{ backpack_url('role') }}">
      Roles
    </a>
    <a class="dropdown-item" href="{{ backpack_url('permission') }}">
      Permissions
    </a>
  </div>
</li>




@if (env('APP_ENV') == 'development')
<!-- Documentations -->
<li class="nav-item">
  <a class="nav-link" href="{{ url('documentation') }}">
    <span class="nav-link-icon d-md-none d-lg-inline-block">
      <i class="icon ti ti-tag"></i>
    </span>
    <span class="nav-link-title">Documentation</span>
  </a>
</li>
@endif