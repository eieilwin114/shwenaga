<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/css/tabler.min.css">
</head>
<body>
    <div class="page-body">
        <div class="container-xl d-flex flex-column justify-content-center">
            <div class="col-4 mx-auto">
                <img class="w-100 rounded-4 shadow-lg" src="/assets/img/logo-gradient.jpg" />
            </div>
            <div class="empty">
                @if (env('APP_ENV') == 'development')
                    <div class="empty-action">
                        <a href="/auth/login/shop-owner" class="btn text-muted btn-link me-3 text-decoration-none">
                            Shop Owner
                        </a>
                        <a href="/auth/login/admin" class="btn text-muted btn-link me-3 text-decoration-none">
                            Stuff App
                        </a>
                        <a href="/get/staff-app" class="btn text-muted btn-link me-3 text-decoration-none">
                            Admin
                        </a>
                    </div>
                @endif
                @if (env('APP_ENV') != 'development')
                    <div class="empty-action">
                        <a href="/admin/login" class="btn text-muted btn-link me-3 text-decoration-none">
                            Shop Owner
                        </a>
                        <a href="/admin/login" class="btn text-muted btn-link me-3 text-decoration-none">
                            Admin
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/js/tabler.min.js"></script>
</body>
</html>