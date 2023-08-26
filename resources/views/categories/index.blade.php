@extends('layouts.app')
@section('title')
    Categories
@endsection
@section('content')
    <div class="row row-cards">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex">
                    <h3 class="card-title">Categories</h3>
                    <a href="#" class="btn ms-auto add-button" data-bs-toggle="modal" data-bs-target="#categoryCreateModal">
                        Add
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable category-datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('categories.create_modal')
    @include('categories.edit_modal')
@endsection
@section('js')
    <script src="{{ mix('assets/js/category/review.js') }}"></script>
@endsection
