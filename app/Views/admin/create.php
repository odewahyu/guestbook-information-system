<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="d-flex" id="wrapper">

    <?= $this->include('/layout/sidebar'); ?>

    <div id="page-content-wrapper">

        <?= $this->include('/layout/navbar'); ?>

        <div class="container-fluid px-3 pb-4">
            <div class="row bg-body px-4 py-3 mx-2 rounded shadow">
                <h5 class="fw-bold mb-3 third-text">Form Tambah Data Admin</h5>
                <hr>
                <form action="/admin/save" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" value="<?= old('username'); ?>" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" id="username" name="username" placeholder="Masukan Username">
                        <div class="invalid-feedback">
                            <?= $validation->getError('username'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                        <input type="text" value="<?= old('nama_lengkap'); ?>" class="form-control <?= ($validation->hasError('nama_lengkap')) ? 'is-invalid' : ''; ?>" id="nama_lengkap" name="nama_lengkap" placeholder="Masukan Nama">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_lengkap'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class=" form-label">E-mail</label>
                        <input type="text" value="<?= old('email'); ?>" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" placeholder="Masukan Email">
                        <div class="invalid-feedback">
                            <?= $validation->getError('email'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="no_telp" class=" form-label">No. Telephone</label>
                        <input type="number" value="<?= old('no_telp'); ?>" class="form-control <?= ($validation->hasError('no_telp')) ? 'is-invalid' : ''; ?>" id="no_telp" name="no_telp" placeholder="Masukan No. Telephone">
                        <div class="invalid-feedback">
                            <?= $validation->getError('no_telp'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="Masukan Password">
                        <div class="invalid-feedback">
                            <?= $validation->getError('password'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class=" form-label">Alamat</label>
                        <input type="text" value="<?= old('alamat'); ?>" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" id="alamat" name="alamat" placeholder="Masukan Alamat">
                        <div class="invalid-feedback">
                            <?= $validation->getError('alamat'); ?>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start">
                        <a href="/admin" class="btn btn-secondary fw-bold me-1">Kembali</a>
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