$(document).ready(function () {
    var table = $('.contact-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: route('contacts.index'),
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'subject', name: 'subject'},
            {data: 'message', name: 'message'}
        ],
        order: [[0, 'desc']]
    });
});
