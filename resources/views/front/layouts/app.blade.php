<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title') | {{ getAppName() }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <!-- Place favicon.ico in the root directory -->
    <link href="{{ asset( getLogoUrl()) }}" type="img/x-icon" rel="shortcut icon">
    <!-- All css files are included here. -->
    <link rel="stylesheet" href="{{ asset('front/assets/css/vendor/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/vendor/iconfont.min.css')}}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/vendor/helper.css')}}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/plugins/plugins.css')}}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/style.css')}}">
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="{{mix('assets/css/front-custom.css')}}" rel="stylesheet" type="text/css">
    <!-- Modernizr JS -->
    <script src="{{ asset('front/assets/js/vendor/modernizr-2.8.3.min.js')}}"></script>
    @yield('front-css')
</head>

<body>

<div id="main-wrapper">
    <!--Header section start-->
    @include('front.layouts.header')
    <!--Header section end-->

    @yield('content')

    <!--Footer section start-->
    @include('front.layouts.footer')
    <!--Footer section end-->
</div>

<!-- All jquery file included here -->
<script src="{{ asset('front/assets/js/vendor/jquery-1.12.4.min.js')}}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfmCVTjRI007pC1Yk2o2d_EhgkjTsFVN8&amp;callback">
</script>
<script src="{{ asset('front/assets/js/vendor/popper.min.js')}}"></script>
<script src="{{ asset('front/assets/js/vendor/bootstrap.min.js')}}"></script>
<script src="{{ asset('front/assets/js/plugins/plugins.js')}}"></script>
<script src="{{ asset('front/assets/js/main.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://kit.fontawesome.com/02860c04b3.js" crossorigin="anonymous"></script>
<script src="{{ mix('assets/js/custom/helpers.js') }}"></script>
<script src="{{ mix('assets/js/custom/front-custom.js') }}"></script>
<script src="{{ mix('assets/js/custom/add-edit-profile-picture.js') }}"></script>

@routes
@yield('front_js')
</body>
</html>