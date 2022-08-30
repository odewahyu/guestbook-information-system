<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="d-flex" id="wrapper">

    <?= $this->include('/layout/sidebar'); ?>

    <div id="page-content-wrapper">

        <?= $this->include('/layout/navbar'); ?>

        <div class="container-fluid px-3 pb-4">
            <div class="row bg-body px-4 py-3 mx-2 rounded shadow">
                <h5 class="fw-bold mb-3 third-text">Form Tambah Data Jabatan</h5>
                <hr>
                <form action="/jabatan/save" method="post">
                    <!-- <input type="hidden" name="id" id="id"> -->
                    <div class="mb-3">
                        <label for="nama_jabatan" class="form-label">Nama Jabatan</label>
                        <input type="text" placeholder="Masukan Nama Jabatan" value="<?= old('nama_jabatan'); ?>" class=" form-control <?= ($validation->hasError('nama_jabatan')) ? 'is-invalid' : ''; ?>" id="nama_jabatan" name="nama_jabatan">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_jabatan'); ?>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start">
                        <a href="/jabatan" class="btn btn-secondary fw-bold me-1">Kembali</a>
                        <button type="submit" class="btn primary-bg text-white fw-bold btnSave">Tambah Data</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

</div>

<script>
    var el = document.getElementById("wrapper");
    var toggleButton = document.getElementById("menu-toggle");

    toggleButton.onclick = function() {
        el.classList.toggle("toggled");
    };
</script>

<?= $this->include('/layout/modals/logoutModal') ?>

<?= $this->endSection(); ?>