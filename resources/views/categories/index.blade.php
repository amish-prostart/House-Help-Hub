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
    </style>
@endsection
@section('content')
    <div class="row row-cards">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex">
                    <h3 class="card-title">Categories</h3>
                    <a href="#" class="btn ms-auto" data-bs-toggle="modal" data-bs-target="#modal-report">
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
    <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
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
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Cancel
                    </a>
                    <a href="#" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                        Save
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
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
    </script>
@endsection
{{--        let categoryCreateUrl = "{{ route('categories.store') }}";--}}
{{--        let categoriesUrl = "{{ url('categories') }}";--}}
{{--    <script src="{{ mix('assets/js/category/category.js') }}"></script>--}}
{{--    <script src="{{ mix('assets/js/custom/delete.js') }}"></script>--}}
