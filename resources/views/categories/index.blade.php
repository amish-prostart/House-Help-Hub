@extends('layouts.app')
@section('title')
    Categories
@endsection
@section('css')
    <style>
    .dataTables_wrapper .dataTables_length {
        float:left;
        margin: 13px;
    }
    .dataTables_wrapper .dataTables_filter {
        float: right;
        margin: 13px;
    }

    #DataTables_Table_0 {
        border-top: var(--tblr-border-width) var(--tblr-border-style) rgba(4,32,69,.14)!important;

    }

    .add-button {
        background-color: black;
        color: white;
    }


    .switch {
        position: relative;
        display: inline-block;
        width: 49px;
        height: 27px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 20px;
        width: 20px;
        left: 2px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
    </style>
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
                            <th>ID</th>
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
@endsection
@section('js')
    <script src="{{ mix('assets/js/category/category.js') }}"></script>
@endsection
{{--        let categoryCreateUrl = "{{ route('categories.store') }}";--}}
{{--        let categoriesUrl = "{{ url('categories') }}";--}}

{{--    <script src="{{ mix('assets/js/custom/delete.js') }}"></script>--}}
