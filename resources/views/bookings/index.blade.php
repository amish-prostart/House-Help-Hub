@extends('layouts.app')
@section('title')
    Bookings
@endsection
@section('content')
    <div class="row row-cards">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex">
                    <h3 class="card-title">Bookings</h3>
                </div>
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap datatable booking-datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer Name</th>
                            <th>Provider Name</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
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
    <script src="{{ mix('assets/js/booking/booking.js') }}"></script>
@endsection
