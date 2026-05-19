<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        
    </head>
    <body class="bg-custom text-white">
        <img src="{{ asset('img/wurl-bg-white.png') }}" class="wurlbg-big position-absolute start-0 w-25" alt="Background Image" style="z-index: -1; opacity: 0.1;">
        <img src="{{ asset('img/wurl-bg-white.png') }}" class="wurlbg-small position-absolute end-0" alt="Background Image" style="z-index: -1; opacity: 0.1;">

        <nav class="navbar mainNavbar navbar-expand-lg">
            <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('index') }}">
                <img src="{{ asset('img/wurl-white.png') }}" alt="Wurl Logo" width="100" class="d-inline-block align-text-top">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav ms-auto">
                <a class="nav-link active text-white nav-link-custom" href="{{ route('index') }}">Home </a>
                <a class="nav-link text-white nav-link-custom" href="{{ route('privacy-policy') }}">Privacy Policy</a>
                <a class="nav-link text-white nav-link-custom" href="mailto:info@wurl.io">Contact Us</a>
                </div>
            </div>
            </div>
        </nav>
        <div class="container midcontainer  mt-5 text-center">
        
            @yield('content')
        </div>
        <footer class="footer mt-5 py-4 bg-dark text-white">
            <div class="container text-center">
            <div class="mb-3">
                <a href="https://x.com/wurlio25" class="text-white me-3" target="_blank" rel="noopener">
                    <i class="bi bi-twitter fs-4"></i>
                </a>
                <a href="https://www.facebook.com/wurl.io" class="text-white me-3" target="_blank" rel="noopener">
                    <i class="bi bi-facebook fs-4"></i>
                </a>
                <a href="https://www.instagram.com/wurl.io/" class="text-white me-3" target="_blank" rel="noopener">
                    <i class="bi bi-instagram fs-4"></i>
                </a>
                <a href="https://www.linkedin.com/company/wurl-io" class="text-white me-3" target="_blank" rel="noopener">
                    <i class="bi bi-linkedin fs-4"></i>
                </a>
                <a href="https://www.pinterest.com/wurlio" class="text-white me-3" target="_blank" rel="noopener">
                    <i class="bi bi-pinterest fs-4"></i>
                </a>
                <a href="mailto:info@wurl.io" class="text-white" target="_blank" rel="noopener">
                    <i class="bi bi-envelope fs-4"></i>
                </a>
                
            </div>
            <div>
                © <?php echo date('Y'); ?> Wurl. All rights reserved.
            </div>
            </div>
        </footer>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        {{-- <script src="{{ asset('js/mainformsubmit.js') }}"></script> --}}
       
    </body>
</html>
