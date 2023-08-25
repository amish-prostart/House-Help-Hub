$(document).ready(function () {
    var table = $('.review-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: route('reviews.index'),
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'message', name: 'message'}
        ],
        order: [[0, 'desc']]
    });
});
