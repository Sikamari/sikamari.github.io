// cek kesiapan jquery
$(document).ready(function () {

    // hilangkan tombol cari
    $('#tombol-cari').hide();

    // even ketika keyword ditulis
    $('#keyword').on('keyup', function () {
        // munculkan icon loading
        $('.loader').show();

        // $.get()
        $.get('ajax/mahasiswa.php?keyword=' + $('#keyword').val(), function (data) {
            $('#container').html(data);
            $('.loader').hide();

        })

        // ajax menggunakan LOAD
        // $('#container').load('ajax/mahasiswa.php?keyword=' + $('#keyword').val());
    });
}) // memulai jquery

// LOAD hanya bisa digunakan dengan method GET