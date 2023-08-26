$(document).ready(function () {
    var table = $('.category-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: route('categories.index'),
        columns: [
            {data: 'id', name: 'id'},
            {data: function (row) {
                    return `<div class="d-flex align-items-center">
    <a href="javascript:void(0)" data-id="${row.id}" class="show-btn">
        <div class="image image-mini me-3">
            <img src="${row.category_url}" alt="user" class="user-img image rounded-circle object-contain user-profile-image">
        </div>
    </a>
</div>`;
                }, name: 'id'},
            {data: 'name', name: 'name'},
            {data: function (row) {
                    let checked = row.status === 1 ? 'checked' : '';
                    return `<label class="switch">
                        <input type="checkbox" name="status" class="category-status" value="1" data-id="${row.id}" ${checked}>
                        <span class="slider round"></span>
                    </label>`
                }, name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        order: [[0, 'desc']]
    });

    $('#categoryCreateForm').submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            data: formData,
            url: route('categories.store'),
            type: "POST",
            contentType: false,
            processData: false,
            success: function (data) {
                $('#categoryCreateForm').trigger("reset");
                $('#categoryCreateModal').modal('hide');
                $(".modal-backdrop").remove();
                toastr.success('Category saved Successfully.');
                table.draw();
            },
            error: function (data) {
                $('#saveBtn').html('Save Changes');
            }
        });
    });

    // category activation deactivation change event
    listenChange('.category-status', function (event) {
        let categoryId = $(event.currentTarget).data('id')
        activeDeActiveCategory(categoryId)
    })

    // activate de-activate category
    window.activeDeActiveCategory = function (id) {
        $.ajax({
            url: route('category.active-deactive',id),
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

    listenClick('.category-edit-btn', function (event) {
        let categoryId = $(event.currentTarget).data('id')
        renderCategoryData(categoryId)
    })

    window.renderCategoryData = function (id) {
        $.ajax({
            url: route('categories.edit',id),
            type: 'GET',
            success: function (result) {
                if (result.success) {
                    let category = result.data
                    console.log(category.category_url)
                    $('#editCategoryID').val(category.id)
                    $('#editCategoryName').val(category.name)
                    if (category.status === 1)
                        $('#editCategoryStatus').prop('checked', true)
                    else
                        $('#editCategoryStatus').prop('checked', false)
                    $('.category-edit-image').css('background-image', 'url("' + category.category_url + '")');
                    $('#categoryEditModal').modal('show')

                }
            },
            error: function (result) {
                manageAjaxErrors(result)
            },
        })
    }

    $('#categoryEditForm').submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        // console.log(formData)
        // return false;
        $('#editCategoryBtn').addClass('disabled');
        var id = $('#editCategoryID').val()
        $.ajax({
            url: route('categories.update',id),
            type: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function (result) {
                if (result.success) {
                    $('#editCategoryBtn').removeClass('disabled');
                    displaySuccessMessage(result.message)
                    $('#categoryEditModal').modal('hide')
                    table.draw();
                }
            },
            error: function (result) {
                UnprocessableInputError(result)
            },
        })
    });

    listenClick('.category-delete-btn', function (event) {
        let categoryId = $(event.currentTarget).data('id')
        deleteItem(route('categories.destroy',categoryId),
            '.category-datatable',
            'Category')
    })

    listen('change', '#categoryImage', function () {
        console.log('image change');
        let extension = isValidDocument($(this), '#categoryValidationErrorsBox')
        console.log(extension);
        if (!isEmpty(extension) && extension != false) {
            $('#userValidationErrorsBox').html('').hide()
            displayDocument(this, '.category-edit-image', extension)
        }
    })

    listenClick('.remove-image', function () {
        defaultImagePreview('#userPreviewImage', 1)
    })
});
