<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Start Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <!-- End Favicon -->
    <title>Welcome</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/css/tabler.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.22.0/tabler-icons.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/css/tabler-flags.min.css" />
</head>
<body>
  @include('_layout.partials.header')
  <div class="page-body mt-0">
      @yield('content')
  </div>
  @include('_layout.partials.footer')
  {{-- <script src="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/js/tabler.min.js"></script> --}}
  @yield('before_scripts')
  @stack('before_scripts')
  @include(backpack_view('inc.scripts'))
  @include(backpack_view('inc.theme_scripts'))
  @yield('after_scripts')
  @stack('after_scripts')
</body>
</html>