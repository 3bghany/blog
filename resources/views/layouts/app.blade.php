<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"  />
        
        <link rel="stylesheet" href="{{asset('backend/css/all.min.css')}}">
        <link rel="stylesheet" href="{{asset('backend/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('backend/css/select2.min.css')}}">
        <link rel="stylesheet" href="{{asset('backend/css/slick.css')}}">
        <link rel="stylesheet" href="{{asset('backend/css/jquery.nice-number.min.css')}}">
        <link rel="stylesheet" href="{{asset('backend/css/jquery.calendar.css')}}">
        <link rel="stylesheet" href="{{asset('backend/css/add_row_custon.css')}}">
        <link rel="stylesheet" href="{{asset('backend/css/mobile_menu.css')}}">
        <link rel="stylesheet" href="{{asset('backend/css/jquery.exzoom.css')}}">
        <link rel="stylesheet" href="{{asset('backend/css/multiple-image-video.css')}}">
        <link rel="stylesheet" href="{{asset('backend/css/ranger_style.css')}}">
        <link rel="stylesheet" href="{{asset('backend/css/jquery.classycountdown.css')}}">
        <link rel="stylesheet" href="{{asset('backend/css/venobox.min.css')}}">
    
        <link rel="stylesheet" href="{{asset('backend/css/style.css')}}">
        <link rel="stylesheet" href="{{asset('backend/css/responsive.css')}}">

        @stack('styles')

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
       <!--jquery library js-->
        <script src="{{asset('backend/js/jquery-3.6.0.min.js')}}"></script>
        <!--bootstrap js-->
        <script src="{{asset('backend/js/bootstrap.bundle.min.js')}}"></script>
        <!--font-awesome js-->
        <script src="{{asset('backend/js/Font-Awesome.j')}}s"></script>
        <!--select2 js-->
        <script src="{{asset('backend/js/select2.min.js')}}"></script>
        <!--slick slider js-->
        <script src="{{asset('backend/js/slick.min.js')}}"></script>
        <!--simplyCountdown js-->
        <script src="{{asset('backend/js/simplyCountdown.js')}}"></script>
        <!--product zoomer js-->
        <script src="{{asset('backend/js/jquery.exzoom.js')}}"></script>
        <!--nice-number js-->
        <script src="{{asset('backend/js/jquery.nice-number.min.js')}}"></script>
        <!--counter js-->
        <script src="{{asset('backend/js/jquery.waypoints.min.js')}}"></script>
        <script src="{{asset('backend/js/jquery.countup.min.js')}}"></script>
        <!--add row js-->
        <script src="{{asset('backend/js/add_row_custon.js')}}"></script>
        <!--multiple-image-video js-->
        <script src="{{asset('backend/js/multiple-image-video.js')}}"></script>
        <!--sticky sidebar js-->
        <script src="{{asset('backend/js/sticky_sidebar.js')}}"></script>
        <!--price ranger js-->
        <script src="{{asset('backend/js/ranger_jquery-ui.min.js')}}"></script>
        <script src="{{asset('backend/js/ranger_slider.js')}}"></script>
        <!--isotope js-->
        <script src="{{asset('backend/js/isotope.pkgd.min.js')}}"></script>
        <!--venobox js-->
        <script src="{{asset('backend/js/venobox.min.js')}}"></script>
        <!--classycountdown js-->
        <script src="{{asset('backend/js/jquery.classycountdown.js')}}"></script> 
    
        <!--main/custom js-->
        <script src="{{asset('backend/js/main.js')}}"></script>

        <script src="{{asset('backend/bootstrap/js/bootstrap.min.js')}}"></script>

        <!--Sweetalert js-->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="//cdn.datatables.net/2.1.4/js/dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/2.1.4/js/dataTables.bootstrap5.js"></script>

@stack('scripts')
        

    </body>
</html>
