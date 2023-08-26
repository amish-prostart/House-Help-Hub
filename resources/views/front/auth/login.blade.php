@extends('front.layouts.app')
@section('title')
    Login
@endsection
@section('content')
    <!-- Breadcrumb Section Start -->
    <div class="breadcrumb-section section bg-black pt-75 pb-75 pt-sm-55 pb-sm-55 pt-xs-45 pb-xs-45">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="breadcrumb-title">
                        <h2>Login</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->

    <!--My Account section start-->
    <div class="my-account section pt-100 pt-lg-80 pt-md-70 pt-sm-60 pt-xs-50  pb-70 pb-lg-50 pb-md-40 pb-sm-30 pb-xs-20">
        <div class="container">
            <div class="row">
                <!--Login Form Start-->
                <div class="col-md-12">
                    <div class="customer-login-register">
                        <div class="form-login-title">
                            <h2>Login</h2>
                        </div>
                        <div class="login-form">
                            <form action="#">
                                <div class="form-fild">
                                    <p><label>Username or email address <span class="required">*</span></label></p>
                                    <input name="username" value="" type="text">
                                </div>
                                <div class="form-fild">
                                    <p><label>Password <span class="required">*</span></label></p>
                                    <input name="password" value="" type="password">
                                </div>
                                <div class="login-submit">
                                    <button type="submit" class="btn">Login</button>
                                    <label>
                                        <input class="checkbox" name="rememberme" value="" type="checkbox">
                                        <span>Remember me</span>
                                    </label>
                                </div>
                                <div class="lost-password">
                                    <a href="#">Lost your password?</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--Login Form End-->
            </div>
        </div>
    </div>
    <!--My Account section end-->

    <!--CTA section start-->
    @include('front.get-quick-note')
    <!--CTA section end-->
@endsection