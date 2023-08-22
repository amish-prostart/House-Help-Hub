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
                        <input type="checkbox" name="status" class="category-status" value="1" data-id="${row.id}" ${checked}>
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
                console.log(result)
                if (result.success) {
                    displaySuccessMessage(result.message)
                    // toastr.success('Category saved Successfully.');
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
                    $('#editCategoryID').val(category.id)
                    $('#editCategoryName').val(category.name)
                    if (category.status === 1)
                        $('#editCategoryStatus').prop('checked', true)
                    else
                        $('#editCategoryStatus').prop('checked', false)
                    $('#categoryEditModal').modal('show')

                }
            },
            error: function (result) {
                manageAjaxErrors(result)
            },
        })
    }


    listenSubmit('#categoryEditForm', function (event) {
        event.preventDefault()
        var loadingButton = jQuery(this).find('#editCategorySave')
        loadingButton.button('loading')
        var id = $('#editMedicineCategoryId').val()
        $.ajax({
            url: $('#indexCategoriesUrl').val() + '/' + id,
            type: 'put',
            data: $(this).serialize(),
            success: function (result) {
                if (result.success) {
                    displaySuccessMessage(result.message)
                    $('#edit_categories_modal').modal('hide')
                    if ($('#categoriesShowUrl').length) {
                        window.location.href = $('#categoriesShowUrl').val()
                    } else {
                        livewire.emit('refresh')
                    }
                }
            },
            error: function (result) {
                UnprocessableInputError(result)
            },
            complete: function () {
                loadingButton.button('reset')
            },
        })
    })

    listenHiddenBsModal('#add_categories_modal', function () {
        resetModalForm('#addMedicineCategoryForm', '#medicineCategoryErrorsBox')
    })

    listenHiddenBsModal('#edit_categories_modal', function () {
        resetModalForm('#editMedicineCategoryForm',
            '#editMedicineCategoryErrorsBox')
    })

    listenClick('.category-delete-btn', function (event) {
        let categoryId = $(event.currentTarget).data('id')
        deleteItem($('#indexCategoriesUrl').val() + '/' + categoryId,
            '#categoriesTable',
            $('#medicineCategoryLang').val())
    })
});
