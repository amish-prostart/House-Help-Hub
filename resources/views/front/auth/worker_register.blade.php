@extends('front.layouts.app')
@section('title')
    Register
@endsection
@section('content')
    <!-- Breadcrumb Section Start -->
    <div class="breadcrumb-section section bg-black pt-75 pb-75 pt-sm-55 pb-sm-55 pt-xs-45 pb-xs-45">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="breadcrumb-title">
                        <h2>Provider/Worker Register</h2>
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
                            <h2>Provider/Worker Registration</h2>
                        </div>
                        @include('flash::message')
                        <div class="login-form">
                            <form method="post" action="{{ route('users.store') }}" enctype="multipart/form-data" id="userCreateForm">
                                @csrf
                                <input type="hidden" name="role" value="Provider">
                                <input type="hidden" name="front_side" value="front-site">
                                <input type="hidden" name="status" value="1">
                                <input type="hidden" name="is_active" value="1">
                                <div class="card-body">
                                    <div class="row row-cards">
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">First Name:<span class="required"></span></label>
                                                <input type="text" class="form-control" placeholder="Enter First Name" name="first_name" value="{{old('first_name')}}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Last Name:<span class="required"></span></label>
                                                <input type="text" class="form-control" placeholder="Enter Last Name" name="last_name" value="{{old('last_name')}}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Email:<span class="required"></span></label>
                                                <input type="text" class="form-control" placeholder="Enter Email" name="email" value="{{old('email')}}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Phone:<span class="required"></span></label>
                                                <div class="input-group mb-2">
                                                    <span class="input-group-text">+91</span>
                                                    <input type="phone" class="form-control" name="phone" placeholder="Enter Phone"  autocomplete="off" value="{{old('phone')}}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Password:<span class="required"></span></label>
                                                <input type="password" class="form-control" name="password" placeholder="Enter Password" value="{{old('password')}}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Confirm Password:<span class="required"></span></label>
                                                <input type="password" class="form-control" name="confirm_password" placeholder="Enter Confirm Password" value="{{old('confirm_password')}}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Gender:<span class="required"></span></label>
                                                <label class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                           name="gender" value="Male" checked>
                                                    <span class="form-check-label">Male</span>
                                                </label>
                                                <label class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                           name="gender" value="Female">
                                                    <span class="form-check-label">Female</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Category:<span class="required"></span></label>
                                                <select class="form-select" name="category_id">
                                                    @foreach($categories as $key => $value)
                                                        <option value="{{$key}}">{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Visit Charge:<span class="required"></span></label>
                                                <input type="text" class="form-control" placeholder="Enter Visit Charge" name="visit_charge" value="{{old('visit_charge')}}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Address:<span class="required"></span></label>
                                                <textarea rows="2" class="form-control" placeholder="Enter Address" name="address" required>{{ old('address') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">City:<span class="required"></span></label>
                                                <input type="text" class="form-control" placeholder="Enter City" name="city" value="{{old('city')}}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">State:<span class="required"></span></label>
                                                <input type="text" class="form-control" placeholder="Enter State" name="state" value="{{old('state')}}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Country:<span class="required"></span></label>
                                                <input type="text" class="form-control" placeholder="Enter Country" name="country" value="{{old('country')}}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="justify-content-center">
                                                <label class="form-label">Profile:<span class="required"></span></label>
                                            </div>
                                            @php
                                                $image = asset('assets/images/avatar.png');
                                            @endphp
                                            <div class="d-block">
                                                <div class="image-picker">
                                                    <div class="image previewImage" id="userPreviewImage"
                                                         style="background-image: url('{{ $image }}')"
                                                    >

                                                    </div>
                                                    <span class="picker-edit rounded-circle text-gray-500 fs-small">
                                    <label>
                                    <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                                        <input type="file" name="image" id="userProfileImage" class="d-none image-upload" accept=".png, .jpg, .jpeg">
                                    </label>
                                </span>
                                                </div>
                                            </div>
                                            <div class="form-text">Allowed file types: png, jpg, jpeg.</div>

                                        </div>

                                    </div>
                                    <div class="card-footer text-end">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
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
@section('front_js')
    <script>
        $(document).ready(function (){
            listen('change', '#userProfileImage', function () {
                let extension = isValidDocument($(this), '#userValidationErrorsBox')
                if (!isEmpty(extension) && extension != false) {
                    $('#userValidationErrorsBox').html('').hide()
                    displayDocument(this, '#userPreviewImage', extension)
                }
            })
        })
    </script>
@endsection