@extends('layouts.app')
@section('title')
    Edit User
@endsection
@section('content')
        <div class="row row-cards">
            <div class="col-12">
                <form class="card" method="post" action="{{ route('users.update',$user->id) }}" enctype="multipart/form-data" id="userEditForm">
                    @csrf
                    @method('put')
                    <input type="hidden" name="front_side" value="back-site">
                    <span id="userValidationErrorsBox"></span>
                    <div class="card-body">
                        <div class="row row-cards">
                            <div class="col-sm-6 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">First Name:<span class="required"></span></label>
                                    <input type="text" class="form-control" placeholder="Enter First Name" name="first_name" value="{{$user->first_name}}" required>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Last Name:<span class="required"></span></label>
                                    <input type="text" class="form-control" placeholder="Enter Last Name" name="last_name" value="{{$user->last_name}}" required>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Email:<span class="required"></span></label>
                                    <input type="text" class="form-control" placeholder="Enter Email" name="email" value="{{$user->email}}" required>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Phone:<span class="required"></span></label>
                                    <div class="input-group mb-2">
                                    <span class="input-group-text">+91</span>
                                    <input type="tel" class="form-control" name="phone" placeholder="Enter Phone"  autocomplete="off" value="{{$user->phone}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Gender:<span class="required"></span></label>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio"
                                               name="gender" value="Male" {{ $user->gender === 'Male' ? 'checked': ''}}>
                                        <span class="form-check-label">Male</span>
                                    </label>
                                    <label class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio"
                                               name="gender" value="Female" {{ $user->gender === 'Female' ? 'checked': ''}}>
                                        <span class="form-check-label">Female</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Role:<span class="required"></span></label>
                                    <select class="form-select" id="userRole" name="role" required>
                                        @foreach($roles as $role)
                                            <option value="{{$role}}" {{ $user->role === $role ? 'selected' : '' }}>{{ $role }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 provider-category-block d-none">
                                <div class="mb-3">
                                    <label class="form-label">Category:<span class="required"></span></label>
                                    <select class="form-select" name="category_id">
                                        @foreach($categories as $key => $value)
                                        <option value="{{$key}}" {{ $user->category_id === $key ? 'selected' : '' }}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 provider-category-block d-none">
                                <div class="mb-3">
                                    <label class="form-label">Visit Charge:<span class="required"></span></label>
                                    <input type="text" class="form-control" placeholder="Enter Visit Charge" name="visit_charge" value="{{$user->visit_charge}}">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Address:<span class="required"></span></label>
                                    <textarea rows="2" class="form-control" placeholder="Enter Address" name="address" required>{{$user->address}}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">City:<span class="required"></span></label>
                                    <input type="text" class="form-control" placeholder="Enter City" name="city" value="{{$user->city}}" required>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">State:<span class="required"></span></label>
                                    <input type="text" class="form-control" placeholder="Enter State" name="state" value="{{$user->state}}" required>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Country:<span class="required"></span></label>
                                    <input type="text" class="form-control" placeholder="Enter Country" name="country" value="{{$user->country}}" required>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                    <div class="justify-content-center">
                                        <label class="form-label">Profile:<span class="required"></span></label>
                                    </div>
                                    <div class="d-block">
                                        <div class="image-picker">
                                            <div class="image previewImage" id="userPreviewImage"
                                                 style="background-image: url('{{ $user->image_url }}')">
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
                            <div class="col-sm-6 col-md-6">
                                <div class="d-flex">
                                    <div>
                                        <label class="form-label">Status</label>
                                        <label class="switch">
                                            <input type="checkbox" name="status" value="1" {{ $user->status === 1 ? 'checked' : null }}>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>

                                    <div class="ms-5">
                                        <label class="form-label">Active</label>
                                        <label class="switch">
                                            <input type="checkbox" name="is_active" value="1" {{ $user->is_active === 1 ? 'checked' : null }}>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>

                                </div>

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
