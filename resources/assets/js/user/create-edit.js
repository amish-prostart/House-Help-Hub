$(document).ready(function () {

    if($("#userRole").val() === 'Provider') {
        $('.provider-category-block').removeClass('d-none');
    }

    $('#userRole').change(function () {
        if($('#userRole').val() === 'Provider') {
            $('.provider-category-block').removeClass('d-none');

        }
        else {
            $('.provider-category-block').addClass('d-none');
        }
    });

    listen('change', '#userProfileImage', function () {
        let extension = isValidDocument($(this), '#userValidationErrorsBox')
        if (!isEmpty(extension) && extension != false) {
            $('#userValidationErrorsBox').html('').hide()
            displayDocument(this, '#userPreviewImage', extension)
        }
    })

    listenClick('.remove-image', function () {
        defaultImagePreview('#userPreviewImage', 1)
    })
});