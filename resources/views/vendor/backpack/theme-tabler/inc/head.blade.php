<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
@if (backpack_theme_config('meta_robots_content'))
<meta name="robots" content="{{ backpack_theme_config('meta_robots_content', 'noindex, nofollow') }}">
@endif
{{-- Encrypted CSRF token for Laravel, in order for Ajax requests to work --}}
<meta name="csrf-token" content="{{ csrf_token() }}"/> 
<title>{{ isset($title) ? $title.' :: '.backpack_theme_config('project_name') : backpack_theme_config('project_name') }}</title>

@yield('before_styles')
<link href="{{ asset('css/main.css') }}" rel="stylesheet">
@stack('before_styles')

@include(backpack_view('inc.styles'))
@include(backpack_view('inc.theme_styles')) 

@yield('after_styles')
@stack('after_styles')
