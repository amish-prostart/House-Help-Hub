@extends('layouts.app')
@section('title')
    Settings
@endsection
@section('content')
    <div class="row row-cards">
        <div class="col-12">
            <form class="card" method="post" action="{{ route('settings.update') }}" enctype="multipart/form-data" id="SettingUpdateForm">
                @csrf
                @include('flash::message')
                <span id="userValidationErrorsBox"></span>
                <div class="card-body">
                    <div class="row row-cards">
                        <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">App Name:<span class="required"></span></label>
                                <input type="text" class="form-control" placeholder="Enter App Name" name="app_name" value="{{$settings['app_name']}}" required>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Email:<span class="required"></span></label>
                                <input type="text" class="form-control" placeholder="Enter Email" name="email" value="{{$settings['email']}}" required>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Phone:<span class="required"></span></label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">+91</span>
                                    <input type="phone" class="form-control" name="phone" placeholder="Enter Phone"  autocomplete="off" value="{{$settings['phone']}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Address:<span class="required"></span></label>
                                <textarea rows="2" class="form-control" placeholder="Enter Address" name="address" required>{{ $settings['address'] }}</textarea>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">City:<span class="required"></span></label>
                                <input type="text" class="form-control" placeholder="Enter City" name="city" value="{{$settings['city']}}" required>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">State:<span class="required"></span></label>
                                <input type="text" class="form-control" placeholder="Enter State" name="state" value="{{$settings['country']}}" required>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Country:<span class="required"></span></label>
                                <input type="text" class="form-control" placeholder="Enter Country" name="country" value="{{$settings['country']}}" required>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="justify-content-center">
                                <label class="form-label">App Logo:<span class="required"></span></label>
                            </div>
                            @php
                                $image = asset('assets/images/avatar.png');
                            @endphp
                            <div class="d-block">
                                <div class="image-picker">
                                    <div class="image previewImage" id="userPreviewImage"
                                         style="background-image: url('{{ $settings['app_logo'] }}')"
                                    >
                                    </div>
                                    <span class="picker-edit rounded-circle text-gray-500 fs-small">
                                    <label>
                                    <i class="fa-solid fa-pen" id="profileImageIcon"></i>
                                        <input type="file" name="app_logo" id="userProfileImage" class="d-none image-upload" accept=".png, .jpg, .jpeg">
                                    </label>
                                </span>
                                </div>
                            </div>
                            <div class="form-text">Allowed file types: png, jpg, jpeg.</div>

                        </div>

                    </div>
                    <div class="card-footer text-end">
                        <a href="{{route('users.index')}}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ mix('assets/js/user/create-edit.js') }}"></script>
@endsection
