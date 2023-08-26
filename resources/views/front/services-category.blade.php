@extends('front.layouts.app')
@section('title')
    {{ $category->name }}
@endsection
@section('content')
    <!-- Breadcrumb Section Start -->
    <div class="breadcrumb-section section bg-black">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="breadcrumb-title pt-75 pb-75 pt-sm-55 pb-sm-55 pt-xs-45 pb-xs-45">
                        <h2>{{ $category->name }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <!--Product section start-->
    <div class="product-section section pt-100 pt-lg-80 pt-md-70 pt-sm-60 pt-xs-50  pb-60 pb-lg-40 pb-md-30 pb-sm-20 pb-xs-10">
        <div class="container">
            <div class="row">

                <div class="col-lg-12 col-12">
                    <div class="tab-content">
                        <div id="all" class="tab-pane fade active show">
                            <div class="row">
                                @foreach($users as $user)
                                <div class="product col-xl-3 col-lg-4 col-sm-6 col-12 mb-40">
                                    <div class="product-inner">
                                        <div class="media">
                                            <a href="{{route('front.services-detail',[$user->category->name,$user->id])}}" class="image"><img class="service-category-image" src="{{ $user->image_url }}" alt=""></a>
                                            <div class="view-btn">
                                                <div class="pentagon-icon work-search-icon">
                                                    <div class="icon">
                                                        <a class="item" href="{{ $user->image_url }}"><i class="fa fa-search"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <h4 class="title"><a href="{{route('front.services-detail',[$user->category->name,$user->id])}}">{{ $user->full_name }}</a></h4>
                                            <span class="posted-in">Category: <a href="#">{{$user->category->name}}</a></span>
                                            <h4 class="price mt-2 mb-2"><span class="new">Visit Charge: ₹{{$user->visit_charge}}</span></h4>
                                            <a href="{{route('front.services-detail',[$user->category->name,$user->id])}}" class="btn">Book</a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--Product section end-->

    <!--CTA section start-->
@include('front.get-quick-note')
    <!--CTA section end-->
@endsection