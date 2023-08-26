@extends('front.layouts.app')
@section('title')
    My Account
@endsection
@section('content')
    <!-- Breadcrumb Section Start -->
    <div class="breadcrumb-section section bg-black pt-75 pb-75 pt-sm-55 pb-sm-55 pt-xs-45 pb-xs-45">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="breadcrumb-title">
                        <h2>My Account</h2>
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
                            <h2>My Account</h2>
                        </div>
                        @include('flash::message')
                        <div class="login-form">
                            <form method="post" action="{{ route('users.update',getLoggedInUser()->id) }}" enctype="multipart/form-data" id="userCreateForm">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="role" value="{{getLoggedInUser()->role}}">
                                <input type="hidden" name="front_side" value="front-site">
                                <input type="hidden" name="status" value="1">
                                <input type="hidden" name="is_active" value="1">
                                <div class="card-body">
                                    <div class="row row-cards">
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">First Name:<span class="required"></span></label>
                                                <input type="text" class="form-control" placeholder="Enter First Name" name="first_name" value="{{getLoggedInUser()->first_name}}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Last Name:<span class="required"></span></label>
                                                <input type="text" class="form-control" placeholder="Enter Last Name" name="last_name" value="{{getLoggedInUser()->last_name}}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Phone:<span class="required"></span></label>
                                                <div class="input-group mb-2">
                                                    <span class="input-group-text">+91</span>
                                                    <input type="phone" class="form-control" name="phone" placeholder="Enter Phone"  autocomplete="off" value="{{getLoggedInUser()->phone}}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Gender:<span class="required"></span></label>
                                                <label class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                           name="gender" value="Male" {{ getLoggedInUser()->gender === 'Male' ? 'checked' : ''}}>
                                                    <span class="form-check-label">Male</span>
                                                </label>
                                                <label class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                           name="gender" value="Female" {{ getLoggedInUser()->gender === 'Female' ? 'checked' : '' }}>
                                                    <span class="form-check-label">Female</span>
                                                </label>
                                            </div>
                                        </div>
                                        @if(getLoggedInUser()->role === 'Provider')
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Visit Charge:<span class="required"></span></label>
                                                <input type="text" class="form-control" placeholder="Enter Visit Charge" name="visit_charge" value="{{getLoggedInUser()->visit_charge}}">
                                            </div>
                                        </div>
                                        @endif
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Address:<span class="required"></span></label>
                                                <textarea rows="2" class="form-control" placeholder="Enter Address" name="address" required>{{ getLoggedInUser()->address }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">City:<span class="required"></span></label>
                                                <input type="text" class="form-control" placeholder="Enter City" name="city" value="{{getLoggedInUser()->city}}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">State:<span class="required"></span></label>
                                                <input type="text" class="form-control" placeholder="Enter State" name="state" value="{{getLoggedInUser()->state}}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Country:<span class="required"></span></label>
                                                <input type="text" class="form-control" placeholder="Enter Country" name="country" value="{{getLoggedInUser()->country}}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <div class="justify-content-center">
                                                <label class="form-label">Profile:<span class="required"></span></label>
                                            </div>
                                            <div class="d-block">
                                                <div class="image-picker">
                                                    <div class="image previewImage" id="userPreviewImage"
                                                         style="background-image: url('{{ getLoggedInUser()->image_url }}')"
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


                <div class="row row-cards" style="padding-top: 30px;">
                    <div class="form-login-title">
                        <h2>Change Password</h2>
                    </div>
                    <div class="col-12">
                        @if($errors->any())
                            {!! implode('', $errors->all('<div style="color:red">:message</div>')) !!}
                        @endif
                        @if(Session::get('error') && Session::get('error') != null)
                            <div style="color:red">{{ Session::get('error') }}</div>
                            @php
                                Session::put('error', null)
                            @endphp
                        @endif
                        @if(Session::get('success') && Session::get('success') != null)
                            <div style="color:green">{{ Session::get('success') }}</div>
                            @php
                                Session::put('success', null)
                            @endphp
                        @endif
                        <form class="card" method="post" action="{{ route('change.password') }}">
                            @csrf
                            <span id="userValidationErrorsBox"></span>
                            <div class="card-body">
                                <div class="row row-cards">
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Old Password:<span class="required"></span></label>
                                            <input type="password" class="form-control" placeholder="Enter Old Password" name="current_password" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">New Password:<span class="required"></span></label>
                                            <input type="password" class="form-control" name="new_password" placeholder="Enter New Password" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Confirm Password:<span class="required"></span></label>
                                            <input type="password" class="form-control" name="new_password_confirmation" placeholder="Enter Confirm Password" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
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