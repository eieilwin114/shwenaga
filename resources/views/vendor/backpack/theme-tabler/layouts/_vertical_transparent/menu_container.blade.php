@if(backpack_auth()->check())
    <!-- Sidebar -->
    <style>
        @media (max-width: 992px) {
            #sidebar-menu {
                position: absolute !important;
                background: #1a2234;
                width: 100%;
                z-index: 99;
                top: 56px;
                right: 0;
            }
        }
        
    </style>
    <aside class="navbar navbar-vertical navbar-expand-lg theme-dark">
        <div class="container-fluid">
            <h1 class="navbar-brand">
                <a href="{{route('home')}}">
                    <img 
                        src="{{url('/assets/img/logo-transparant.png')}}" 
                        height="48" alt="Shwe Nagar" class="navbar-brand-image">
                </a>
            </h1>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav pt-lg-3">
                @include(backpack_view('inc.sidebar_content'))
            </ul>
            </div>
        </div>
    </aside>
    <script>
        var toggleButtons = document.getElementsByClassName("navbar-toggler")[0];
        // console.log('hello',toggleButtons);

        toggleButtons.addEventListener('click', function() {
            var elements = document.getElementsByClassName("collapse")[0];
            elements.classList.toggle('show');
        });
    </script>
@endif









{{-- 
@if(backpack_auth()->check())
    <aside class="{{ backpack_theme_config('classes.sidebar') ?? 'navbar navbar-vertical navbar-expand-lg' }} @if(backpack_theme_config('options.sidebarFixed')) navbar-fixed @endif">
        <div class="container-fluid">
            <ul class="nav navbar-nav d-flex flex-row align-items-center justify-content-between w-100 d-block d-lg-none">
                @include(backpack_view('layouts.partials.mobile_toggle_btn'), ['forceWhiteLabelText' => true])
                <div class="d-flex flex-row align-items-center">
                    <li class="nav-item me-2">
                        @includeWhen(backpack_theme_config('options.showColorModeSwitcher'), backpack_view('layouts.partials.switch_theme'))
                    </li>
                    @include(backpack_view('inc.menu_user_dropdown'))
                </div>
            </ul>
            <h1 class="navbar-brand d-none d-lg-block align-self-center mb-3">
                <a class="h2 text-decoration-none mb-0" href="{{ url(backpack_theme_config('home_link')) }}" title="{{ backpack_theme_config('project_name') }}">
                    {!! backpack_theme_config('project_logo') !!}
                </a>
            </h1>
            <div class="collapse navbar-collapse" id="mobile-menu">
                <ul class="navbar-nav pt-lg-3">
                    <li class="px-3 fw-bold">{{ ucfirst(strtolower(trans('backpack::base.administration'))) }}</li>
                    @include(backpack_view('inc.sidebar_content'))
                </ul>
            </div>
        </div>
    </aside>
@endif --}}
