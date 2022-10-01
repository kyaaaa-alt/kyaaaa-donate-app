const donateBtn = document.getElementById('donateBtn')

function validateEmail(mail) {
    return (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail))
}

function makePayment(url, privacy = false) {
    const formData = document.getElementById('donate_form')
    const data = new FormData(formData);
    if (privacy == true) {
        data.append('private', 'yes')
    } else {
        data.append('private', 'no')
    }
    fetch(url, {
        method: 'POST',
        body: data
    }).then((response) => response.json())
        .then((data) => {
            if (data.success != true) {
                Swal.fire({
                    icon: 'warning',
                    text: data.msg,
                    showConfirmButton: false,
                    timer: 5000
                })
            } else {
                location.href = data.invoice
            }
        });
}

function doDonate(url) {
    const name = document.getElementById('name').value
    const email = document.getElementById('email').value
    const msgs = document.getElementById('msgs').value
    const donate_amount = document.getElementById('amount').value
    if (name == '' || email == '' || msgs == '' || donate_amount == '') {
        Swal.fire({
            icon: 'warning',
            text: 'harap isi nama, email, pesan, dan jumlah dukungan!',
            showConfirmButton: false,
            timer: 2500
        })
    } else if (!validateEmail(email)) {
        Swal.fire({
            icon: 'warning',
            text: 'format email salah!',
            showConfirmButton: false,
            timer: 2500
        })
    } else {
        Swal.fire({
            icon:'question',
            title: 'Dukung sebagai anonim?',
            text: 'Nominal dukungan dan pesan akan disembunyikan.',
            showCancelButton: false,
            confirmButtonText: 'Tidak',
            confirmButtonColor: '#3650c0',
            denyButtonColor: '#3650c0',
            showDenyButton: true,
            denyButtonText: 'Ya',
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
                Swal.fire({
                    timer: 5000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                    }
                })
                makePayment(url);
            } else if (result.isDenied) {
                Swal.fire({
                    timer: 5000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                    }
                })
                makePayment(url, true);
            }
        })
    }

}