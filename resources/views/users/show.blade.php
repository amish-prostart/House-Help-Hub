@extends('layouts.app')
@section('title')
    Users
@endsection
@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Users</h3>
                    <a href="{{route('users.edit',$user->id)}}" class="btn ms-auto add-button">
                        Edit
                    </a>
                </div>
                <div class="card-body">
                    <div class="datagrid">
                        <div class="datagrid-item">
                            <div class="datagrid-title">First Name:</div>
                            <div class="datagrid-content">{{$user->first_name}}</div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">Last Name:</div>
                            <div class="datagrid-content">{{$user->last_name}}</div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">Email:</div>
                            <div class="datagrid-content">{{$user->email}}</div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">Phone:</div>
                            <div class="datagrid-content">{{$user->phone}}</div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">Gender:</div>
                            <div class="datagrid-content">{{$user->gender}}</div>
                        </div>

                        <div class="datagrid-item">
                            <div class="datagrid-title">Role:</div>
                            <div class="datagrid-content">{{$user->role}}</div>
                        </div>

                        @if($user->category)
                        <div class="datagrid-item">
                            <div class="datagrid-title">Category:</div>
                            <div class="datagrid-content">{{$user->category->name}}</div>
                        </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Old Price:</div>
                                <div class="datagrid-content">{{$user->old_price}}</div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">New Price:</div>
                                <div class="datagrid-content">{{$user->new_price}}</div>
                            </div>
                            <div class="datagrid-item">
                                <div class="datagrid-title">Work Description:</div>
                                <div class="datagrid-content">{{$user->work_description}}</div>
                            </div>
                        @endif
                        <div class="datagrid-item">
                            <div class="datagrid-title">Address:</div>
                            <div class="datagrid-content">{{$user->address}}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">City:</div>
                            <div class="datagrid-content">{{$user->city}}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">State:</div>
                            <div class="datagrid-content">Third Party{{$user->state}}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Country:</div>
                            <div class="datagrid-content">{{$user->country}}</div>
                        </div>
                        <div class="datagrid-item">
                            <div class="datagrid-title">Image:</div>
                            <img src="{{$user->image_url}}" class="user-show-image" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ mix('assets/js/user/user.js') }}"></script>
@endsection
