<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="d-flex" id="wrapper">

    <?= $this->include('/layout/sidebar'); ?>

    <div id="page-content-wrapper">

        <?= $this->include('/layout/navbar'); ?>

        <div class="container-fluid px-3 pb-4">
            <div class="row bg-body px-4 py-3 mx-2 rounded shadow">
                <h5 class="fw-bold mb-3 third-text">Form Edit Data Pegawai</h5>
                <hr>
                <form action="/pegawai/update" method="post">
                    <input type="hidden" value="<?= $pegawai['id_pegawai'] ?>" name="id" id="id">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" value="<?= (old('username')) ? old('username') : $pegawai['username'] ?>" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" class="form-control" id="username" name="username" placeholder="Masukan Username">
                        <div class="invalid-feedback">
                            <?= $validation->getError('username'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                        <input type="text" value="<?= (old('nama_lengkap')) ? old('nama_lengkap') : $pegawai['nama_lengkap'] ?>" class="form-control <?= ($validation->hasError('nama_lengkap')) ? 'is-invalid' : ''; ?>" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Masukan Nama">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_lengkap'); ?>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="jabatan">Jabatan</label>
                        <select class="form-select" id="jabatan" name="jabatan">
                            <?php foreach ($jabatan as $j) : ?>
                                <option value="<?= $j['id_jabatan']; ?>" <?= ($j['id_jabatan'] == $pegawai['id_jabatan']) ? 'selected' : '' ?>><?= $j['nama_jabatan']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="text" value="<?= (old('email')) ? old('email') : $pegawai['email'] ?>" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" class="form-control" id="email" name="email" placeholder="Masukan Email">
                        <div class="invalid-feedback">
                            <?= $validation->getError('email'); ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="no_telp" class="form-label">No. Telephone</label>
                        <input type="number" value="<?= (old('no_telp')) ? old('no_telp') : $pegawai['no_telephone'] ?>" class="form-control <?= ($validation->hasError('no_telp')) ? 'is-invalid' : ''; ?>" class="form-control" id="no_telp" name="no_telp" placeholder="Masukan No. Telephone">
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
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" value="<?= (old('alamat')) ? old('alamat') : $pegawai['alamat'] ?>" class="form-control <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" id="alamat" name="alamat" placeholder="Masukan Alamat">
                        <div class="invalid-feedback">
                            <?= $validation->getError('alamat'); ?>
                        </div>
                    </div>
                    <div class="d-flex justify-content-start">
                        <a href="/pegawai" class="btn btn-secondary fw-bold me-1">Kembali</a>
                        <button type="submit" class="btn primary-bg text-white fw-bold btnSave">Ubah Data</button>
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