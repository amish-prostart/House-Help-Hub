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
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {
                var table = $('.category-datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: route('categories.index'),
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'name', name: 'name'},
                        {data: function (row) {
                                let checked = row.status === 1 ? 'checked' : '';
                                return `<label class="switch">
                        <input type="checkbox" name="status" >
                        <span class="slider round"></span>
                    </label>`
                            }, name: 'status'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ],
                    order: [[0, 'desc']]
                });

            // Show category modal for creating/editing
            // $('#categoryCreateForm').on('click', function () {
            //     $('#categoryId').val('');
            //     $('#name').val('');
            //     $('#status').val(1);
            //     $('#categoryModal').modal('show');
            // });

            // Save category using AJAX
            $('#addCategoryBtn').on('click', function (e) {
                e.preventDefault();

                $.ajax({
                    data: $('#categoryCreateForm').serialize(),
                    url: route('categories.store'),
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#categoryCreateForm').trigger("reset");
                        $('#categoryCreateModal').modal('hide');
                        toastr.success('Category saved Successfully.');
                        table.draw();

                    },
                    error: function (data) {
                        $('#saveBtn').html('Save Changes');
                    }
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
            $(document).on('click', '#categoryDeleteBtn', function (e) {
                e.preventDefault();
                var categoryId = $(this).data('id');
                swal({
                        title: "Do you want to delete this User?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn",
                        confirmButtonText: "Confirm",
                        cancelButtonText: "Cancel",
                        closeOnConfirm: true,
                        closeOnCancel: true,
                        timer: 5000
                    }).then(function (e) {
                        $.ajax({
                            type: 'DELETE',
                            url: route('categories.destroy',categoryId),
                            dataType: 'JSON',
                            success: function (results) {
                                if (results.success === true) {
                                    swal("Done!", results.message, "success");
                                    // refresh page after 2 seconds
                                    setTimeout(function(){
                                        location.reload();
                                    },2000);
                                } else {
                                    swal.fire("Error!", results.message, "error");
                                }
                            }
                        });
                }, function (dismiss) {
                    return false;
                })
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
