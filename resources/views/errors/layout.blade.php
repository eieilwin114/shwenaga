@php
  $title = 'Error '.$error_number;
@endphp
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/css/tabler.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.22.0/tabler-icons.min.css" />
</head>
<body>

  <div class="page page-center">
    <div class="container-tight py-4">
      <div class="empty">
        <div class="empty-header">{{ $error_number }}</div>
        <p class="empty-title">
          @yield('title')
        </p>
        <p class="empty-subtitle text-muted">
          @yield('description')
        </p>
        <div class="empty-action">
          <a href="/" class="btn btn-primary">
            <!-- Download SVG icon from http://tabler-icons.io/i/arrow-left -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l6 6" /><path d="M5 12l6 -6" /></svg>
            Take me home
          </a>
        </div>
      </div>
    </div>
  </div>

    



    @include('_layout.partials.footer')
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/js/tabler.min.js"></script>
    <style>
    .error_number {
      font-size: 156px;
      font-weight: 600;
      line-height: 100px;
    }
    .error_number small {
      font-size: 56px;
      font-weight: 700;
    }

    .error_number hr {
      margin-top: 60px;
      margin-bottom: 0;
      width: 50px;
    }

    .error_title {
      margin-top: 40px;
      font-size: 36px;
      font-weight: 400;
    }

    .error_description {
      font-size: 24px;
      font-weight: 400;
    }
    </style>
</body>
</html>

