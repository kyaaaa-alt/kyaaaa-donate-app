function makePayment(url) {
    fetch(url, {
        method: 'POST',
    }).then((response) => response.json())
        .then((data) => {
            if (data.success != true) {
                Swal.fire({
                    icon: 'warning',
                    text: 'Failed',
                    showConfirmButton: false,
                    timer: 2000
                })
            } else {
                Swal.fire('Ok, check the overlay!', '', 'success')
            }
        });
}

function doOverlayTest(url) {
    Swal.fire({
        icon:'question',
        title: 'Test Overlay Donation?',
        html: 'before you go, put this link <br/>( <a target="_blank" style="color:#84ffae !important;text-decoration: none;" href="'+ url +'donate_notification">'+ url +'donate_notification</a> ) <br/>to your stream app or open in new tab on your browser',
        showCancelButton: false,
        confirmButtonText: 'Test Now',
        confirmButtonColor: '#3650c0',
        showDenyButton: true,
        denyButtonText: 'Cancel',
        reverseButtons: true,
        allowOutsideClick:false,
        customClass: {
            actions: 'my-actions',
            cancelButton: 'order-1 right-gap',
            confirmButton: 'order-2',
            denyButton: 'order-3',
        }
    }).then((result) => {
        if (result.isConfirmed) {
            makePayment(url + 'test_notification');
        } else if (result.isDenied) {
            Swal.dismiss();
        }
    })

}