<?php date_default_timezone_set('Asia/Makassar');?>

<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid third-bg">
    <div class="row d-flex justify-content-center align-items-center">
        <div class=" col-8 bg-body px-3 py-4 shadow my-5">
            <div class="col-12 d-flex justify-content-center mb-2">
                <h3 class="fw-bold third-text text-center">SISTEM INFORMASI BUKU TAMU KANTOR CAMAT MENGWI</h2>
            </div>
            <div class="col-12 d-flex justify-content-center mb-2">
                <img src="/img/iconcamat.png" alt="icon" width="199" height="200">
            </div>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="col-12">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashData('pesan'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            <?php endif; ?>
            <h5 class="fw-bold mb-3 third-text">Form Kunjungan Tamu</h5>
            <hr>
            <div class="mb-3">
                <h6 class="fs-6 fst-italic fw-light">Email, instansi, tanggal, dan jam kunjungan wajib diisi untuk melakukan permintaan kunjungan tamu.</h6>
            </div>
            <form action="/formkunjungantamu/save" method="post">
                <div class="mb-3">
                    <label for="nama_lengkap" class="form-label">Nama<span class="text-danger">*</span></label>
                    <input type="text" placeholder="Masukan Nama" value="<?= old('nama_lengkap'); ?>" class=" form-control <?= ($validation->hasError('nama_lengkap')) ? 'is-invalid' : ''; ?>" id="nama_lengkap" name="nama_lengkap" autocomplete="off">
                    <div class="invalid-feedback">
                        <?= $validation->getError('nama_lengkap'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" placeholder="nama@example.com" value="<?= old('email'); ?>" class="form-control" id="email" name="email" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="no_telp" class="form-label">No. Telephone<span class="text-danger">*</span></label>
                    <input type="number" placeholder="081235453888" value="<?= old('no_telp'); ?>" class="form-control <?= ($validation->hasError('no_telp')) ? 'is-invalid' : ''; ?>" id="no_telp" name="no_telp" autocomplete="off">
                    <div class="invalid-feedback">
                        <?= $validation->getError('no_telp'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat<span class="text-danger">*</span></label>
                    <input type="text" placeholder="Masukan Alamat" value="<?= old('alamat'); ?>" class=" form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" id="alamat" name="alamat" autocomplete="off">
                    <div class="invalid-feedback">
                        <?= $validation->getError('alamat'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="instansi" class="form-label">Instansi</label>
                    <input type="text" placeholder="Masukan Instansi" value="<?= old('instansi'); ?>" class="form-control" id="instansi" name="instansi" autocomplete="off">
                </div>
                <div class="form-group mb-3">
                    <label for="keperluan" class="form-label">Keperluan<span class="text-danger">*</span></label>
                    <select class="form-select" id="keperluan-tamu" name="keperluan">
                        <option value="Bertemu Camat">Bertemu Camat</option>
                        <option value="Bertemu Ketua Sekretariat">Bertemu Ketua Sekretariat</option>
                        <option value="Membuat KTP">Membuat KTP</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tgl_kunjungan" class="form-label">Tanggal Kunjungan</label>
                    <input type="date" class="form-control" id="tgl_kunjungan" name="tgl_kunjungan" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="jam_kunjungan" class="form-label">Jam Kunjungan</label>
                    <input type="time" class="form-control" id="jam_kunjungan" name="jam_kunjungan" autocomplete="off">
                </div>
                <button class="btn primary-bg text-white fw-bold col-12 mt-2" type="submit">Submit</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>