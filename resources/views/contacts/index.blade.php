@extends('layouts.app')
@section('title')
    Contacts
@endsection
@section('content')
    <div class="row row-cards">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex">
                    <h3 class="card-title">Contacts</h3>
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable contact-datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ mix('assets/js/contact/contact.js') }}"></script>
@endsection
