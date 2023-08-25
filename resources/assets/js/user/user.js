$(document).ready(function () {
    console.log('users js')
    var table = $('.user-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: route('users.index'),
        columns: [
            {data: 'id', name: 'id'},
            {data: function (row) {
                    return `<div class="d-flex align-items-center">
    <a href="javascript:void(0)" data-id="${row.id}" class="show-btn">
        <div class="image image-mini me-3">
            <img src="${row.image_url}" alt="user" class="user-img image rounded-circle object-contain user-profile-image">
        </div>
    </a>
    <div class="d-flex flex-column">
        <a href="javascript:void(0)" class="mb-1 show-user-btn text-decoration-none" data-id="{{ $row->id }}">
            ${row.full_name}
        </a>
        <span class="fs-6">${row.email}</span>
    </div>
</div>`;
                }, name: 'name'},
            {data: 'role', name: 'role'},
            {data: function (row) {
                    let checked = row.status === 1 ? 'checked' : '';
                    return `<label class="switch">
                        <input type="checkbox" name="status" class="user-status" value="1" data-id="${row.id}" ${checked}>
                        <span class="slider round"></span>
                    </label>`
                }, name: 'status'},
            {data: function (row) {
                    let isActive = row.is_active === 1 ? 'checked' : '';
                    return `<label class="switch">
                        <input type="checkbox" name="status" class="user-active-deactive" value="1" data-id="${row.id}" ${isActive}>
                        <span class="slider round"></span>
                    </label>`
                }, name: 'is_active'},
            {data: function (row) {
                    let emailVerified = row.email_verified_at ? 'checked disabled' : '';
                    return `<label class="switch">
                        <input type="checkbox" name="status" class="user-email-verified" value="1" data-id="${row.id}" ${emailVerified}>
                        <span class="slider round"></span>
                    </label>`
                }, name: 'email_verified_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        order: [[0, 'desc']]
    });

    // category activation deactivation change event
    listenChange('.user-status', function (event) {
        let userId = $(event.currentTarget).data('id')
        activeDeActiveStatus(userId)
    })

    // activate de-activate category
    window.activeDeActiveStatus = function (id) {
        $.ajax({
            url: route('users.active-deactive',id),
            method: 'post',
            cache: false,
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message)
                    table.draw();
                }
            },
        })
    }

    // category activation deactivation change event
    listenChange('.user-active-deactive', function (event) {
        let userId = $(event.currentTarget).data('id')
        activeDeActive(userId)
    })

    // activate de-activate category
    window.activeDeActive = function (id) {
        $.ajax({
            url: route('users.active-deactive-user',id),
            method: 'post',
            cache: false,
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message)
                    table.draw();
                }
            },
        })
    }

    // category activation deactivation change event
    listenChange('.user-email-verified', function (event) {
        let userId = $(event.currentTarget).data('id')
        activeUserEmail(userId)
    })

    // activate de-activate category
    window.activeUserEmail = function (id) {
        $.ajax({
            url: route('users.email-verified',id),
            method: 'post',
            cache: false,
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message)
                    table.draw();
                }
            },
        })
    }

    listenClick('.user-delete-btn', function (event) {
        let userId = $(event.currentTarget).data('id')
        deleteItem(route('users.destroy',userId),
            '.user-datatable',
            'User')
    })
});
