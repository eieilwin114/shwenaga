<header class="navbar navbar-expand-md d-print-none m-0">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand d-none-navbar-horizontal pe-0 pe-md-3">
            <a href=".">
                <img src="/assets/img/logo-transparant.png" width="32" height="32" alt="Myanma Shwe Nagar Logo" class="navbar-brand-image me-3">
            </a>
        </h1>
        <div class="navbar-nav flex-row order-md-last">
          @include('_layout.partials.btn-theme')
          @if (backpack_auth()->check())
            <div class="ms-2 pt-2">
                @include('vendor.backpack.theme-tabler.inc.menu_user_dropdown')
            </div>
          @endif          
        </div>



    </div>
</header>