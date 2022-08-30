<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="d-flex" id="wrapper">

    <?= $this->include('/layout/sidebar'); ?>

    <div id="page-content-wrapper">

        <?= $this->include('/layout/navbar'); ?>

        <div class="container-fluid px-3 pb-4">
            <div class="row bg-body px-4 py-3 mx-2 rounded shadow">
                <h5 class="fw-bold mb-3 third-text">Form Tambah Data Tamu</h5>
                <hr>
                <form action="/tamu/save" method="post">
                    <!-- <input type="hidden" name="id" id="id"> -->
                    <div class="mb-3">
                        <label for="nama_lengkap" class="form-label">Nama</label>
                        <input type="text" placeholder="Masukan Nama" value="<?= old('nama_lengkap'); ?>" class="form-control <?= ($validation->hasError('nama_lengkap')) ? 'is-invalid' : ''; ?>" id="nama_lengkap" name="nama_lengkap">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_lengkap'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" placeholder="Masukan Email" value="<?= old('email'); ?>" class="form-control" id="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="no_telp" class="form-label">No. Telephone</label>
                        <input type="text" placeholder="Masukan No. Telephone" value="<?= old('no_telp'); ?>" class="form-control <?= ($validation->hasError('no_telp')) ? 'is-invalid' : ''; ?>" id="no_telp" name="no_telp">
                        <div class="invalid-feedback">
                            <?= $validation->getError('no_telp'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" placeholder="Masukan Alamat" value="<?= old('alamat'); ?>" class=" form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" id="alamat" name="alamat">
                        <div class="invalid-feedback">
                            <?= $validation->getError('alamat'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="instansi" class="form-label">Instansi</label>
                        <input type="text" placeholder="Masukan Nama Instansi" value="<?= old('instansi'); ?>" class="form-control" id="instansi" name="instansi">
                    </div>
                    <div class="form-group mb-3">
                        <label for="keperluan" class="form-label">Keperluan</label>
                        <select class="form-select" id="keperluan" name="keperluan">
                            <option value="Bertemu Camat">Bertemu Camat</option>
                            <option value="Bertemu Ketua Sekretariat">Bertemu Ketua Sekretariat</option>
                            <option value="Membuat KTP">Membuat KTP</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tgl_kunjungan" class="form-label">Tanggal Kunjungan</label>
                        <input type="date" value="<?= old('tgl_kunjungan'); ?>" class=" form-control <?= ($validation->hasError('tgl_kunjungan')) ? 'is-invalid' : ''; ?>" id="tgl_kunjungan" name="tgl_kunjungan" autocomplete="off">
                        <div class="invalid-feedback">
                            <?= $validation->getError('tgl_kunjungan'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="jam_kunjungan" class="form-label">Jam Kunjungan</label>
                        <input type="time" value="<?= old('jam_kunjungan'); ?>" class=" form-control <?= ($validation->hasError('jam_kunjungan')) ? 'is-invalid' : ''; ?>" id="jam_kunjungan" name="jam_kunjungan" autocomplete="off">
                        <div class="invalid-feedback">
                            <?= $validation->getError('jam_kunjungan'); ?>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="ruangan" class="form-label">Ruangan</label>
                        <select class="form-select" id="ruangan" name="ruangan">
                            <option value="-">-</option>
                            <option value="Camat">Ruang Camat</option>
                            <option value="Sekretariat">Ruang Sekretariat</option>
                            <option value="Pelayanan Umum">Ruang Pelayanan Umum</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-start">
                        <a href="/tamu" class="btn btn-secondary fw-bold me-1">Kembali</a>
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