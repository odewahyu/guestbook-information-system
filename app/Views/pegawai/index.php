<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="d-flex" id="wrapper">

    <?= $this->include('/layout/sidebar'); ?>

    <div id="page-content-wrapper">

        <?= $this->include('/layout/navbar'); ?>

        <div class="container-fluid px-4">
            <div class="row">
                <?php if (session()->getFlashdata('pesan')) : ?>
                    <div class="col-4">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= session()->getFlashData('pesan'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="row d-flex align-items-center justify-content-between">
                <div class="col-auto">
                    <a href="/pegawai/create" class="btn secondary-bg text-white mt-3 p-2 fw-bold">
                        <i class="fas fa-user-plus me-2"></i>
                        Tambah Data
                    </a>
                </div>
                <div class="col-10 mt-3">
                    <form action="" method="post">
                        <div class="input-group">
                            <input type="text" name="keyword" class="form-control p-2" placeholder="Search" aria-label="Search" aria-describedby="button-addon2" autocomplete="off">
                            <button class="btn primary-bg text-white" type="submit" id="button-addon2"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-md table-responsive">
                    <table class="table table-hover bg-white rounded-2 shadow-sm">
                        <thead class="secondary-bg text-white">
                            <tr>
                                <th class="text-center" scope="col">No.</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Jabatan</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">No. Telephone</th>
                                <th scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 + (10 * ($currentPage - 1)); ?>
                            <?php foreach ($pegawai as $p) : ?>
                                <tr class="align-middle">
                                    <th class="text-center" scope="row"><?= $i; ?>.</th>
                                    <td><?= $p['nama_lengkap']; ?></td>
                                    <td><?= $p['nama_jabatan']; ?></td>
                                    <td><?= $p['email']; ?></td>
                                    <td><?= $p['alamat']; ?></td>
                                    <td><?= $p['no_telephone']; ?></td>
                                    <td>
                                        <a href="/pegawai/edit/<?= $p['id_pegawai'] ?>" class="btn text-center yellow-bg text-white fw-bold">
                                            Edit
                                        </a>
                                        <a href="/pegawai/delete/<?= $p['id_pegawai'] ?>" class="btn btn-danger text-center fw-bold tampilDeletePegawai" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $p['id_pegawai']; ?>">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?= $pager->links('pegawai', 'custom_pagination'); ?>
                </div>
            </div>
        </div>

    </div>

</div>

<div class=" modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="exampleModalLabel">Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/pegawai/delete" method="post">
                    <input type="hidden" name="id_delete" id="id_delete">
                    Apakah anda akan menghapus data ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="fw-bold btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button class="fw-bold btn btn-danger" type="submit">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->include('/layout/modals/logoutModal') ?>

<?= $this->endSection(); ?>