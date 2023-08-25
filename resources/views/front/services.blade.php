@extends('front.layouts.app')
@section('title')
    Services
@endsection
@section('content')
    <!-- Breadcrumb Section Start -->
    <div class="breadcrumb-section section bg-black">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="breadcrumb-title pt-75 pb-75 pt-sm-55 pb-sm-55 pt-xs-45 pb-xs-45">
                        <h2>Services</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->
    <!--Service section start-->
    <div class="service-section section pt-100 pt-lg-80 pt-md-70 pt-sm-60 pt-xs-50 pb-70 pb-lg-50 pb-md-40 pb-sm-30 pb-xs-20">
        <div class="container">
            <div class="row">
                @foreach($categories as $category)
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <!-- Single Service Start -->
                    <div class="single-service-two mb-30">
                        <div class="service-image">
                            <a href="{{ route('front.services-category',[$category->name,$category->id]) }}"><img src="{{$category->category_url}}" alt=""></a>
                        </div>
                        <div class="service-icon-wrap">
                            <div class="service-icon pentagon-icon">
                                <h3><a href="{{ route('front.services-category',[$category->name,$category->id]) }}">{{ $category->name }}</a></h3>
                            </div>
                        </div>
                    </div>
                    <!-- Single Service End -->
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!--Service section end-->
@endsection