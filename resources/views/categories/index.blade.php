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
    </style>
@endsection
@section('content')
    <div class="row row-cards">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex">
                    <h3 class="card-title">Categories</h3>
                    <a href="#" class="btn ms-auto add-button" data-bs-toggle="modal" data-bs-target="#modal-report">
                        Add
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable data-table">
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
    <div class="modal fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Categories</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="example-text-input" placeholder="Enter Category name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary ms-auto" data-bs-dismiss="modal">Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">

    </script>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            // Load categories on page load
            // loadCategories();

            $(function () {

                var table = $('.data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('categories.index') }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'name', name: 'name'},
                        {data: 'status', name: 'status'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });

            });

            // Show category modal for creating/editing
            $('#createCategory').on('click', function () {
                $('#categoryId').val('');
                $('#name').val('');
                $('#status').val(1);
                $('#categoryModal').modal('show');
            });

            // Save category using AJAX
            $('#saveCategory').on('click', function () {
                var categoryId = $('#categoryId').val();
                var name = $('#name').val();
                var status = $('#status').val();

                $.ajax({
                    url: categoryId ? '/categories/' + categoryId : '/categories',
                    type: categoryId ? 'PUT' : 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        name: name,
                        status: status,
                    },
                    success: function (response) {
                        loadCategories();
                        $('#categoryModal').modal('hide');
                    },
                });
            });

            // Edit category
            $('#categoryTableBody').on('click', '.edit-category', function () {
                var categoryId = $(this).data('id');

                $.ajax({
                    url: '/categories/' + categoryId + '/edit',
                    type: 'GET',
                    success: function (response) {
                        $('#categoryId').val(response.category.id);
                        $('#name').val(response.category.name);
                        $('#status').val(response.category.status);
                        $('#categoryModal').modal('show');
                    },
                });
            });

            // Delete category
            $('#categoryTableBody').on('click', '.delete-category', function () {
                var categoryId = $(this).data('id');

                if (confirm('Are you sure you want to delete this category?')) {
                    $.ajax({
                        url: '/categories/' + categoryId,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}',
                        },
                        success: function (response) {
                            loadCategories();
                        },
                    });
                }
            });

            // Load categories using AJAX
            function loadCategories() {
                $.ajax({
                    url: '/categories',
                    type: 'GET',
                    success: function (response) {
                        var categories = response.categories;
                        var categoryTable = '';

                        for (var i = 0; i < categories.length; i++) {
                            var statusBadge = categories[i].status ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-secondary">Inactive</span>';
                            categoryTable += '<tr><td>' + categories[i].name + '</td><td>' + statusBadge + '</td><td><button class="btn btn-sm btn-info edit-category" data-id="' + categories[i].id + '">Edit</button> <button class="btn btn-sm btn-danger delete-category" data-id="' + categories[i].id + '">Delete</button></td></tr>';
                        }

                        $('#categoryTableBody').html(categoryTable);
                    },
                });
            }
        });
    </script>
@endsection
{{--        let categoryCreateUrl = "{{ route('categories.store') }}";--}}
{{--        let categoriesUrl = "{{ url('categories') }}";--}}
{{--    <script src="{{ mix('assets/js/category/category.js') }}"></script>--}}
{{--    <script src="{{ mix('assets/js/custom/delete.js') }}"></script>--}}
