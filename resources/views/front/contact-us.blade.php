@extends('front.layouts.app')
@section('title')
    Contact Us
@endsection
@section('content')
    <!-- Breadcrumb Section Start -->
    <div class="breadcrumb-section section bg-black pt-75 pb-75 pt-sm-55 pb-sm-55 pt-xs-45 pb-xs-45">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="breadcrumb-title">
                        <h2>Contact Us</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <!--Contact Section Start-->
    <div class="contact-section section pt-100 pt-lg-80 pt-md-70 pt-sm-60 pt-xs-50 pb-100 pb-lg-80 pb-md-70 pb-sm-60 pb-xs-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="emergncy-contact-two">
                        <div class="contact-hot-line-area black pr-0 mb-30">
                            <div class="hot-line-image">
                                <img src="{{ asset('front/assets/images/bg/contact-hot-line.jpg')}}" alt="">
                            </div>
                            <div class="hot-line-content">
                                <h4>24/7 HOTLINE</h4>
                                <h2>{{ getPhone() }}</h2>
                            </div>
                        </div>
                        <p>Every home owner has a list of renovation, home repair, or home improvement project he or she needs done both interior and exterior</p>
                        <div class="single-emergncy-contact icon-black content-black mb-30">
                            <div class="pentagon-icon contact-icon">
                                <div class="icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                            </div>
                            <div class="content">
                                <h3>{{ getPhone() }}</h3>
                                <span>{{ getEmail() }}</span>
                            </div>
                        </div>
                        <div class="single-emergncy-contact icon-black content-black mb-30">
                            <div class="pentagon-icon contact-icon">
                                <div class="icon">
                                    <i class="fa fa-home"></i>
                                </div>
                            </div>
                            <div class="content">
                                <h3>{{ getAddress() }}</h3>
                                <span>{{ getCity() }}, {{ getState() }},{{ getCountry() }}.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-12">
                            <div class="contact-form-wrap">
                                <form id="contactUsForm" action="#" method="post">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="contact-form-style mb-20">
                                                <label> Your Name (required)</label>
                                                <input name="name" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="contact-form-style mb-20">
                                                <label>Your Email (required)</label>
                                                <input name="email" type="email">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="contact-form-style mb-20">
                                                <label> Subject</label>
                                                <input name="subject" type="text">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="contact-form-style">
                                                <label> Your Message</label>
                                                <textarea name="message" placeholder="Type your message here.."></textarea>
                                                <button class="btn" type="submit"><span>Send message</span></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <p class="form-messege"></p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--Contact Section End-->

@endsection
@section('front_js')
    <script>
        $(document).ready(function () {
            $('#contactUsForm').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                $.ajax({
                    data: formData,
                    url: route('contacts.store'),
                    type: "POST",
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        $('#contactUsForm').trigger("reset");
                        toastr.success('Contact submitted successfully.');
                    },
                    error: function (data) {
                        toastr.error(data.responseJSON.message);
                    }
                });
            });
        })
    </script>
@endsection