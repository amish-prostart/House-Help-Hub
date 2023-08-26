@extends('front.layouts.app')
@section('title')
    Users
@endsection
@section('content')
    <!--slider section start-->
    <div class="hero-section section position-relative">
        <div class="hero-slider section">

            <!--Hero Item start-->
            <div class="hero-item bg-image" data-bg="{{ asset('front/assets/images/hero/hero-14.jpg')}}">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 offset-lg-6">

                            <!--Hero Content start-->
                            <div class="hero-content-2 center">
                                <img src="{{ asset('front/assets/images/hero/home01-slide01-obj4.png')}}" alt="">
                                <h2 class="sm-size">PROFESSIONAL</h2>
                                <h3 class="sm-size white">HOME SERVICES</h3>
                                <a href="about.html" class="btn">FIND OUT MORE <i class="fa fa-angle-double-right"></i></a>
                            </div>
                            <!--Hero Content end-->

                        </div>
                    </div>
                </div>
            </div>
            <!--Hero Item end-->
            <!--Hero Item start-->
            <div class="hero-item bg-image" data-bg="{{ asset('front/assets/images/hero/hero-2.jpg')}}">
                <div class="container">
                    <div class="row">
                        <div class="col-12">

                            <!--Hero Content start-->
                            <div class="hero-content-2 center">
                                <img src="{{ asset('front/assets/images/hero/home01-slide02-obj1.png')}}" alt="">
                                <h1 class="mid-size-white">We can do Anything!</h1>
                                <a href="about.html" class="btn">FIND OUT MORE <i class="fa fa-angle-double-right"></i></a>
                            </div>
                            <!--Hero Content end-->

                        </div>
                    </div>
                </div>
            </div>
            <!--Hero Item end-->
            <!--Hero Item start-->
            <div class="hero-item bg-image" data-bg="{{ asset('front/assets/images/hero/hero-3.jpg')}}">
                <div class="container">
                    <div class="row">
                        <div class="col-12">

                            <!--Hero Content start-->
                            <div class="hero-content-2">
                                <img class="left-img" src="{{ asset('front/assets/images/hero/home01-slide01.png')}}" alt="">
                                <h2 class="sm-size">PROFESSIONAL</h2>
                                <h3 class="sm-size white">HOME SERVICES</h3>
                                <a href="about.html" class="btn">FIND OUT MORE <i class="fa fa-angle-double-right"></i></a>
                            </div>
                            <!--Hero Content end-->

                        </div>
                    </div>
                </div>
            </div>
            <!--Hero Item end-->

        </div>
    </div>
    <!--slider section end-->

    <!--Features section start-->
    <div class="features-section section pt-95 pt-lg-75 pt-md-65 pt-sm-55 pt-xs-45 pb-65 pb-lg-45 pb-md-35 pb-sm-25 pb-xs-15">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section-title text-left mb-35">
                        <h1>Our Features</h1>
                        <p>From complete turn key to perfect house. Leave the building to the professionals.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <!-- Single Features Start -->
                    <div class="feature-wrap">
                        <div class="feature-style-2 mb-35">
                            <div class="content">
                                <h4><a href="#">Professional Housekeeper</a></h4>
                                <p>From exhaust fan assessment to reviewing attic space and cleaning refrigerator coils to give you a safe life.</p>
                            </div>
                            <div class="features-icon">
                                <i class="pe-7s-cash"></i>
                            </div>
                        </div>
                    </div>
                    <!-- Single Features End -->
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <!-- Single Features Start -->
                    <div class="feature-wrap">
                        <div class="feature-style-2 mb-35">
                            <div class="content">
                                <h4><a href="#">24/7 Services</a></h4>
                                <p>If you are in emergency situation, please do not worry. We provide 24/7 service. Whenever you call, we service you.</p>
                            </div>
                            <div class="features-icon">
                                <i class="pe-7s-cash"></i>
                            </div>
                        </div>
                    </div>
                    <!-- Single Features End -->
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                    <!-- Single Features Start -->
                    <div class="feature-wrap">
                        <div class="feature-style-2 mb-35">
                            <div class="content">
                                <h4><a href="#">Affordable Price</a></h4>
                                <p>We do more than a renovation service- we check for glitches that need attention to keep you safe and save your money.</p>
                            </div>
                            <div class="features-icon">
                                <i class="pe-7s-cash"></i>
                            </div>
                        </div>
                    </div>
                    <!-- Single Features End -->
                </div>
            </div>
        </div>
    </div>
    <!--Features section end-->

    <!--Clasic Service Two section start-->
    <div class="clasic-service-section-three section bg-image jarallax pt-md-70 pb-md-70 pt-sm-60 pb-sm-60" data-bg="{{ asset('front/assets/images/bg/service-bg.jpg')}}">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-xl-6 col-lg-12">
                    <div class="clasic-service-content-three">
                        <h2>We Are Professional & Thoughful Housekeeper</h2>
                        <p>HouseHelpHub was established in response to the growing need for quality housing and commercial space in the city. Since then, we have grown to be one of the leading real housekeeping serving the needs of a discerning clientele.</p>
                        <ul>
                            <li>We have high quality labor who are trainned every year with latest technology.</li>
                            <li>We have 15 year experience in building market.</li>
                            <li>Material from the top partner in market.</li>
                            <li>Update the tendency from around the world.</li>
                        </ul>
                        <a class="btn" href="#"> View Our Projects <i class="fa fa-angle-double-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-6">

                </div>
            </div>
        </div>
    </div>
    <!--Clasic Service Two section end-->

    <!--Service section Title start-->
    <div class="service-section-title bg-black section pt-65 pt-sm-55 pt-xs-45 pb-35 pb-sm-20 pb-xs-10">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section-title text-left color-white mb-35">
                        <h1>Our Services</h1>
                        <p>From complete turn key to perfect house. Leave the building to the professionals.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Service section Title end-->

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
                    <a class="btn mt-10 service-more-btn" href="{{ route('front.services') }}">View More</a>
            </div>
        </div>
    </div>
    <!--Service section end-->

    <!--Contact section start-->
    <div class="contact-section section fix bg-image jarallax" data-bg="{{ asset('front/assets/images/bg/contact-bg.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="offset-lg-6 col-lg-6 bg-black">
                    <div class="contact-area">
                        <div class="row">
                            <div class="col">
                                <div class="section-title color-white text-left mb-35">
                                    <h1>Get A Quick Quote</h1>
                                    <p>Creating a sustainable future through building preservation, green architecture, and smart design.</p>
                                </div>
                            </div>
                        </div>
                        <div class="contact-form">
                            <form action="https://htmldemo.net/murphy/murphy/assets/php/mail.php">
                                <div class="row row-5">
                                    <div class="col-md-6">
                                        <div class="contact-form-style mb-10">
                                            <input name="name" placeholder="Your Name*" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="contact-form-style mb-10">
                                            <input name="email" placeholder="Email*" type="email">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="contact-form-style mb-10">
                                            <input name="subject" placeholder="Subject*" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="contact-form-style mb-10">
                                            <input name="phone" placeholder="Phone*" type="number">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="contact-form-style">
                                            <textarea name="message" placeholder="Type your message here.."></textarea>
                                            <button class="btn mt-10" type="submit"><span>Send message</span></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!--Contact section end-->
@endsection