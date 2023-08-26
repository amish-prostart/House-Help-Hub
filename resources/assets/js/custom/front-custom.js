'use strict'

// let jsrender = require('jsrender')
let csrfToken = $('meta[name="csrf-token"]').attr('content')
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': csrfToken,
    },
})

$('[data-control="select2"]').each(function () {
    $(this).select2()
});


$('.alert').delay(5000).slideUp(300)

window.printErrorMessage = function (selector, errorResult) {
    // $(selector).show().html("");
    // $(selector).text(errorResult.responseJSON.message);
    displayErrorMessage(errorResult.responseJSON.message)
}

toastr.options = {
    'closeButton': true,
    'debug': false,
    'newestOnTop': false,
    'progressBar': true,
    'positionClass': 'toast-top-right',
    'preventDuplicates': false,
    'onclick': null,
    'showDuration': '300',
    'hideDuration': '1000',
    'timeOut': '5000',
    'extendedTimeOut': '1000',
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};

window.manageAjaxErrors = function (data) {
    var errorDivId = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'editValidationErrorsBox';

    if (data.status == 404) {
        toastr.error(data.responseJSON.message);
    } else {
        printErrorMessage("#" + errorDivId, data);
    }
};



window.displaySuccessMessage = function (message) {
    toastr.success(message);
};

window.displayErrorMessage = function (message) {
    toastr.error(message);
};

window.displayPhoto = function (input, selector) {
    let displayPreview = true;
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
            let image = new Image();
            image.src = e.target.result;
            image.onload = function () {
                $(selector).attr('src', e.target.result);
                displayPreview = true;
            };
        };
        if (displayPreview) {
            reader.readAsDataURL(input.files[0]);
            $(selector).show();
        }
    }
};

window.isValidFile = function (inputSelector, validationMessageSelector) {
    let ext = $(inputSelector).val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
        $(inputSelector).val('');
        $(validationMessageSelector).
        html('The image must be a file of type: jpeg, jpg, png.').
        removeClass('d-none').
        show();
        setTimeout(function () {
            $(validationMessageSelector).slideUp(300);
        }, 5000);

        return false;
    }
    $(validationMessageSelector).addClass('d-none')

    return true;
};



let defaultAvatarImageUrl = 'asset(\'assets/img/avatar.png\')'
window.defaultImagePreview = function (imagePreviewSelector, id = null) {
    if (id == 1) {
        $(imagePreviewSelector).
        css('background-image', 'url("' + defaultAvatarImageUrl + '")')
    } else {
        $(imagePreviewSelector).
        css('background-image',
            'url("' + $('.defaultDocumentImageUrl').val() + '")')
    }
}


window.displayDocument = function (input, selector, extension) {
    let displayPreview = true
    if (input.files && input.files[0]) {
        let reader = new FileReader()
        reader.onload = function (e) {
            let image = new Image()
            if ($.inArray(extension, ['pdf', 'doc', 'docx', 'mp3', 'mp4']) ==
                -1) {
                image.src = e.target.result
            } else {
                if (extension == 'pdf') {
                    $('#editPhoto').
                    css('background-image',
                        'url("' + $('.pdfDocumentImageUrl').val() + '")')
                    image.src = $('.pdfDocumentImageUrl').val()
                } else if (extension == 'mp3') {
                    image.src = $('.audioDocumentImageUrl').val()
                } else if (extension == 'mp4') {
                    image.src = $('.videoDocumentImageUrl').val()
                } else {
                    image.src = $('.docxDocumentImageUrl').val()
                }
            }
            image.onload = function () {
                $(selector).attr('src', image.src);
                $(selector).css('background-image',
                    'url("' + image.src + '")');
                displayPreview = true;
            };
        };
        if (displayPreview) {
            reader.readAsDataURL(input.files[0]);
            $(selector).show();
        }
    }
};



