<div class="nav-item dropdown">
    <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
        
        <div class="d-none d-xl-block ps-2">
            <div>{{ backpack_user()->name }}</div>
            <div class="mt-1 small text-muted">{{ __('Admin') }}</div>
        </div>
    </a>
    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
        <a href="{{ route('backpack.account.info') }}" class="dropdown-item">
            <i class="ti ti-user me-2"></i>{{ trans('backpack::base.my_account') }}
        </a>
        <div class="dropdown-divider"></div>
        <a href="{{ backpack_url('logout') }}" class="dropdown-item">
            <i class="ti ti-lock me-2"></i>{{ trans('backpack::base.logout') }}
        </a>
    </div>
</div>
