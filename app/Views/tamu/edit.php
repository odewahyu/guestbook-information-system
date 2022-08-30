<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="d-flex" id="wrapper">

    <?= $this->include('/layout/sidebar'); ?>

    <div id="page-content-wrapper">

        <?= $this->include('/layout/navbar'); ?>

        <div class="container-fluid px-3 pb-4">
            <div class="row bg-body px-4 py-3 mx-2 rounded shadow">
                <h5 class="fw-bold mb-3 third-text">Form Edit Data Tamu</h5>
                <hr>
                <form action="/tamu/update" method="post">
                    <input type="hidden" value="<?= $tamu['id_tamu']; ?>" name="id" id="id">
                    <div class="mb-3">
                        <label for="nama_lengkap" class="form-label">Nama</label>
                        <input type="text" value="<?= (old('nama_lengkap')) ? old('nama_lengkap') : $tamu['nama_lengkap'] ?>" class="form-control <?= ($validation->hasError('nama_lengkap')) ? 'is-invalid' : ''; ?>" placeholder="Masukan Nama" class="form-control" id="nama_lengkap" name="nama_lengkap">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_lengkap'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" value="<?= (old('email')) ? old('email') : (($tamu['email'] == '-') ? '' : $tamu['email']) ?>" class="form-control" placeholder="Masukan Email" class="form-control" id="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="no_telp" class="form-label">No. Telephone</label>
                        <input type="text" value="<?= (old('no_telp')) ? old('no_telp') : $tamu['no_telephone'] ?>" class="form-control <?= ($validation->hasError('no_telp')) ? 'is-invalid' : ''; ?>" placeholder="Masukan No. Telephone" class="form-control" id="no_telp" name="no_telp">
                        <div class="invalid-feedback">
                            <?= $validation->getError('no_telp'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" value="<?= (old('alamat')) ? old('alamat') : $tamu['alamat'] ?>" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" placeholder="Masukan Alamat" class="form-control" id="alamat" name="alamat">
                        <div class="invalid-feedback">
                            <?= $validation->getError('alamat'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="instansi" class="form-label">Instansi</label>
                        <input type="text" value="<?= (old('instansi')) ? old('instansi') : $tamu['instansi'] ?>" class="form-control" placeholder="Masukan Nama Instansi" class="form-control" id="instansi" name="instansi">
                    </div>
                    <div class="form-group mb-3">
                        <label for="keperluan" class="form-label">Keperluan</label>
                        <select class="form-select" id="keperluan" name="keperluan">
                            <option value="Bertemu Camat" <?= ($tamu['keperluan'] == 'Bertemu Camat') ? 'selected' : '' ?>>Bertemu Camat</option>
                            <option value="Bertemu Ketua Sekretariat" <?= ($tamu['keperluan'] == 'Bertemu Ketua Sekretariat') ? 'selected' : '' ?>>Bertemu Ketua Sekretariat</option>
                            <option value="Membuat KTP" <?= ($tamu['keperluan'] == 'Membuat KTP') ? 'selected' : '' ?>>Membuat KTP</option>
                            <option value="Lainnya" <?= ($tamu['keperluan'] == 'Lainnya') ? 'selected' : '' ?>>Lainnya</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tgl_kunjungan" class="form-label">Tanggal Kunjungan</label>
                        <input type="date" value="<?= (old('tgl_kunjungan')) ? old('tgl_kunjungan') : $tamu['tanggal_kunjungan'] ?>" class="form-control <?= ($validation->hasError('tgl_kunjungan')) ? 'is-invalid' : ''; ?>" class="form-control" id="tgl_kunjungan" name="tgl_kunjungan" autocomplete="off">
                        <div class="invalid-feedback">
                            <?= $validation->getError('tgl_kunjungan'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="jam_kunjungan" class="form-label">Jam Kunjungan</label>
                        <input type="time" value="<?= (old('jam_kunjungan')) ? old('jam_kunjungan') : $tamu['jam_kunjungan'] ?>" class="form-control <?= ($validation->hasError('jam_kunjungan')) ? 'is-invalid' : ''; ?>" class="form-control" id="jam_kunjungan" name="jam_kunjungan" autocomplete="off">
                        <div class="invalid-feedback">
                            <?= $validation->getError('jam_kunjungan'); ?>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="ruangan" class="form-label">Ruangan</label>
                        <select class="form-select" id="ruangan" name="ruangan">
                            <option value="-" <?= ($tamu['ruang_kunjungan'] == '-') ? 'selected' : '' ?>>-</option>
                            <option value="Camat" <?= ($tamu['ruang_kunjungan'] == 'Camat') ? 'selected' : '' ?>>Ruang Camat</option>
                            <option value="Sekretariat" <?= ($tamu['ruang_kunjungan'] == 'Sekretariat') ? 'selected' : '' ?>>Ruang Sekretariat</option>
                            <option value="Pelayanan Umum" <?= ($tamu['ruang_kunjungan'] == 'Pelayanan Umum') ? 'selected' : '' ?>>Ruang Pelayanan Umum</option>
                            <option value="Membuat KTP" <?= ($tamu['ruang_kunjungan'] == 'Lainnya') ? 'selected' : '' ?>>Lainnya</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="Diterima" <?= ($tamu['status'] == 'Diterima') ? 'selected' : '' ?>>Diterima</option>
                            <option value="Ditolak" <?= ($tamu['status'] == 'Ditolak') ? 'selected' : '' ?>>Ditolak</option>
                            <option value="Selesai" <?= ($tamu['status'] == 'Selesai') ? 'selected' : '' ?>>Selesai</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-start">
                        <a href="/tamu" class="btn btn-secondary fw-bold me-1">Kembali</a>
                        <button type="submit" class="btn primary-bg text-white fw-bold btnSave">Edit Data</button>
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