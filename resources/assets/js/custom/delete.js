'use strict';

window.deleteItem = function (
    url, tableId = null, header, callFunction = null) {
    swal({
        title: 'Delete!',
        text: 'Are you sure you want to delete this?',
        icon: sweetAlertIcon,
        buttons: {
            confirm: 'Yes, Delete',
            cancel: 'No, Cancel',
        },
    }).then((result) => {
        if (result) {
            Livewire.emit('resetPage')
            deleteItemAjax(url, tableId = null, header, callFunction = null)
        }
    });
};

function deleteItemAjax (url, tableId = null, header, callFunction = null) {
    $.ajax({
        url: url,
        type: 'DELETE',
        dataType: 'json',
        success: function (obj) {
            if (obj.success) {
                Livewire.emit('resetPage')
            }
            swal({
                icon: 'success',
                title: 'Deleted',
                confirmButtonColor: '#f62947',
                text: header + ' has been deleted',
                timer: 2000,
                buttons: {
                    confirm: 'Ok',
                },
            })
            if (callFunction) {
                eval(callFunction);
            }
        },
        error: function (data) {
            swal({
                title: '',
                text: data.responseJSON.message,
                confirmButtonColor: '#009ef7',
                icon: 'error',
                timer: 5000,
                buttons: {
                    confirm: 'Ok',
                },
            })
        },
    })
}
