var el = document.getElementById("wrapper");
var toggleButton = document.getElementById("menu-toggle");

toggleButton.onclick = function () {
    el.classList.toggle("toggled");
};

$(function () {

    $('.tampilDeleteAdmin').on('click', function () {

        const id = $(this).data('id');
        $('#id_delete').val(id);
    });

    $('.tampilDeletePegawai').on('click', function () {

        const id = $(this).data('id');
        $('#id_delete').val(id);
    });

    $('.tampilDeleteJabatan').on('click', function () {

        const id = $(this).data('id');
        $('#id_delete').val(id);
    });

    $('.tampilDeleteTamu').on('click', function () {

        const id = $(this).data('id');
        $('#id_delete').val(id);
    });

    $('.tampilTolakTamu').on('click', function () {

        const id = $(this).data('id');
        $('#id_tolak').val(id);
    });

    $('.tampilTerimaTamu').on('click', function () {

        const id = $(this).data('id');
        $('#id_terima').val(id);
    });

    $('.tampilSelesaiJadwal').on('click', function () {

        const id = $(this).data('id');
        $('#id_selesai').val(id);
    });

});