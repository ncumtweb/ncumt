<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title> 中央大學登山社 - @yield('title') </title>
    <meta content="" name="description">
    <meta content=" 中央大學登山社 " name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/ncumt.png') }}" rel="icon">
    <!-- <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->
    

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500&family=Inter:wght@400;500&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">

    <!-- Template Main CSS Files -->
    <link href="{{ asset('assets/css/variables.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

    <!-- =======================================================
    * Template Name: ZenBlog
    * Updated: Mar 10 2023 with Bootstrap v5.2.3
    * Template URL: https://bootstrapmade.com/zenblog-bootstrap-blog-template/
    * Author: BootstrapMade.com
    * License: https:///bootstrapmade.com/license/
    ======================================================== -->
    </head>
    <body>
        @include('basic.navbar')

        <main id="main">
            {{-- <div class="container"> --}}
                @yield('content')
            {{-- </div> --}}
        </main>

        @include('basic.footer')
    </body>
</html>
