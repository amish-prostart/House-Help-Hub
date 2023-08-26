$(document).ready(function () {
    var table = $('.booking-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: route('bookings.index'),
        columns: [
            {data: 'id', name: 'id'},
            {data: function (row) {
                    return row.customer.full_name;
                }, name: 'id'},
            {data: function (row) {
                    return row.provider.full_name;
                }, name: 'id'},
            {data: 'date', name: 'date'},
            {data: 'time', name: 'time'},
            {data: 'status', name: 'status'}
        ],
        order: [[0, 'desc']]
    });
});
