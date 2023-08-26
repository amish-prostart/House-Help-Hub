@extends('front.layouts.app')
@section('title')
    {{ $category->name }}
@endsection
@section('content')
    <!-- Breadcrumb Section Start -->
    <div class="breadcrumb-section section bg-black pt-75 pb-75 pt-sm-55 pb-sm-55 pt-xs-45 pb-xs-45">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="breadcrumb-title">
                        <h2>Details</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <!--Product section start-->
    <div class="product-section section pt-100 pt-lg-80 pt-md-70 pt-sm-60 pt-xs-50  pb-50 pb-lg-30 pb-md-20 pb-sm-10 pb-xs-0">
        <div class="container">
            <div class="row">

                <div class="col-lg-12">
                    <div class="row">

                        <div class="product-details col-12 mb-50 mb-sm-40 mb-xs-30">
                            <div class="product-inner row">
                                <div class="col-md-6 col-12 mb-xs-30">
                                    <div class="product-image-slider">
                                        <div class="item"><a href="{{ $user->image_url}}" class="gallery-popup"><i class="pe-7s-search"></i>
                                                <img class="service-detail-large-image" src="{{ $user->image_url}}" alt=""></a></div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="content">
                                        <h3 class="title">{{ $user->full_name }}</h3>
                                        <h3 class="price mt-5">
                                            <span class="new ms-0">Visit Charge: ₹{{$user->visit_charge}}</span>
                                        </h3>
                                        <form action="#" method="post" id="categoryDetailForm">
                                            @csrf
                                            <input type="hidden" name="customer_id" value="1">
                                            <input type="hidden" name="provider_id" value="{{ $user->id }}">
                                            <input type="hidden" name="status" value="Pending">
                                            <input type="hidden" name="category_name" value="{{$user->category->name}}">
                                        <div class="product-meta mb-30 d-flex">
                                            <div>
                                                <label>Select Date:</label>
                                                <input type="date" name="date" class="form-control" min="<?php echo date("Y-m-d"); ?>" required>
                                            </div>
                                            <div>
                                                <label>Select Time:</label>
                                                <select name="time"class="form-control" required>
                                                    <option value="">Select Time</option>
                                                    @foreach($bookingTimes as $bookingTime)
                                                        <option value="{{$bookingTime}}">{{$bookingTime}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="actions">
                                            <button type="submit" class="btn">Book Now</button>
                                        </div>
                                        </form>
                                        <div class="product-meta mb-30">
                                            <span class="posted-in">Category: <a href="#">{{$user->category->name}}</a></span>
                                            <span class="posted-in">Go Cashless: <a href="#">Pay Online after your service PayTm and other.</a></span>
                                            <span class="posted-in">Professionals: <a href="#">Inhouse Verified and Trained Professionals</a></span>
                                            <span class="posted-in">Insurance: <a href="#">Upto Rs 5000 against damages
AMC Available</a></span>
                                            <span class="posted-in">Service Guarantee: <a href="#">Service Guarantee Upto 365 Days of Service*(AMC)</a></span>
                                        </div>

                                        <ul class="product-details-tab-list nav">
                                            <li><a class="active show" href="#product-description" data-bs-toggle="tab">Description</a></li>
                                            <li><a href="#product-review" data-bs-toggle="tab">Review</a></li>
                                        </ul>

                                        <div class="tab-content">
                                            <div id="product-description" class="tab-pane active show">
                                                <div class="product-description">
                                                    <ul>
                                                        <li>₹ 199 will be charged for 1st hour.</li>
                                                        <li>₹ 99 will be charged for next 30 minutes following to 1st hour.</li>
                                                        <li>₹ 99 will be charged in case of Inspection only.</li>
                                                        <li>Material procurement time will be included in service time.</li>
                                                        <li>Required Material cost is excluded from above cost.</li>
                                                        <li>₹ Cash on Delivery Available</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div id="product-review" class="tab-pane">
                                                <div class="product-review">

                                                    <div class="review-form">
                                                        <h4>Leave Your Review</h4>
                                                        <form action="#" method="post" id="categoryReviewForm">
                                                            @csrf
                                                            <div class="row row-10">
                                                                <div class="col-md-12 col-12 mb-20">
                                                                    <input type="text" name="name" placeholder="Your Name">
                                                                </div>
                                                                <div class="col-md-12 col-12 mb-20">
                                                                    <input type="email" name="email" placeholder="Your Email">
                                                                </div>
                                                                <div class="col-12 mb-20">
                                                                    <textarea name="message" placeholder="Your Review"></textarea>
                                                                </div>
                                                                <div class="col-12"><button type="submit" class="btn">Submit</button></div>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row">

                                <div class="col-12">
                                    <div class="section-title no-icon mb-30">
                                        <h3>Related Helpers</h3>
                                    </div>
                                </div>

                                <div class="product-slider-4 section">
                                    @foreach($relatedHelpers as $helper)
                                    <div class="product col-xl-4 col-lg-6 col-sm-6 col-12 mb-40">
                                        <div class="product-inner">
                                            <div class="media">
                                                <a href="{{route('front.services-detail',[$helper->category->name,$helper->id])}}" class="image"><img class="service-category-image" src="{{ $helper->image_url }}" alt=""></a>
                                                <a href="{{route('front.services-detail',[$helper->category->name,$helper->id])}}" class="btn">Book Now</a>
                                            </div>
                                            <div class="content">
                                                <h4 class="title"><a href="{{route('front.services-detail',[$helper->category->name,$helper->id])}}">{{ $helper->full_name }}</a></h4>
                                                <span class="posted-in">Category: <a href="#">{{$helper->category->name}}</a></span>
                                                <h4 class="price"><span class="new">₹{{$helper->visit_charge}}</span></h4>
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
    </div>
    <!--Product section end-->

    <!--CTA section start-->
    @include('front.get-quick-note')
    <!--CTA section end-->
@endsection
@section('front_js')
    <script>
        $(document).ready(function () {
            $('#categoryDetailForm').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                $.ajax({
                    data: formData,
                    url: route('bookings.store'),
                    type: "POST",
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        $('#categoryDetailForm').trigger("reset");
                        toastr.success('Booking created successfully.');
                    },
                    error: function (data) {
                        toastr.error(data.responseJSON.message);
                    }
                });
            });

            $('#categoryReviewForm').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                $.ajax({
                    data: formData,
                    url: route('reviews.store'),
                    type: "POST",
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        $('#categoryReviewForm').trigger("reset");
                        toastr.success('Review submitted successfully.');
                    },
                    error: function (data) {
                        toastr.error(data.responseJSON.message);
                    }
                });
            });
        })
    </script>
@endsection