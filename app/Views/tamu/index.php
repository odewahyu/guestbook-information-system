<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="d-flex" id="wrapper">

    <?= $this->include('/layout/sidebar'); ?>

    <div id="page-content-wrapper">

        <?= $this->include('/layout/navbar'); ?>

        <div class="container-fluid px-4">
            <div class="row">
                <?php if (session()->getFlashdata('pesan')) : ?>
                    <div class="col-5">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= session()->getFlashData('pesan'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                <?php elseif (session()->getFlashdata('pesanerror')) : ?>
                    <div class="col-5">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <?= session()->getFlashData('pesanerror'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="row d-flex align-items-center justify-content-between">
                <div class="col-auto">
                    <a href="/tamu/create" class="btn secondary-bg text-white mt-3 p-2 fw-bold">
                        <i class="fas fa-user-plus me-2"></i>
                        Tambah Tamu
                    </a>
                </div>
                <div class="col-5 mt-3">
                    <form action="/tamu/cetaklaporan" method="get">
                        <div class="input-group">
                            <input type="date" value="<?= date('Y-m-d'); ?>" class="form-control p-2" id="tanggal_awal" name="tanggal_awal" autocomplete="off">
                            <input type="date" value="<?= date('Y-m-d'); ?>" class="form-control p-2" id="tanggal_akhir" name="tanggal_akhir" autocomplete="off">
                            <button class="btn primary-bg text-white fw-bold" type="submit" id="button-addon2">Cetak</button>
                        </div>
                    </form>
                </div>
                <div class="col-12 mt-3">
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
                            <tr class="align-middle">
                                <th class="text-center" scope="col">No.</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Instansi</th>
                                <th scope="col">Keperluan</th>
                                <th scope="col">Tanggal Kunjungan</th>
                                <th scope="col">Jam Kunjungan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 + (10 * ($currentPage - 1)); ?>
                            <?php foreach ($tamu as $t) : ?>
                                <tr class="align-middle">
                                    <th class="text-center" scope="row"><?= $i; ?>.</th>
                                    <td><?= $t['nama_lengkap']; ?></td>
                                    <td><?= $t['instansi']; ?></td>
                                    <td><?= $t['keperluan']; ?></td>
                                    <td><?= $t['tanggal_kunjungan']; ?></td>
                                    <td><?= $t['jam_kunjungan']; ?></td>
                                    <td>
                                        <?php if ($t['status'] == 'Diterima') : ?>
                                            <div class="badge bg-primary"><?= $t['status']; ?></div>
                                        <?php elseif ($t['status'] == 'Ditolak') : ?>
                                            <div class="badge bg-danger"><?= $t['status']; ?></div>
                                        <?php elseif ($t['status'] == 'Selesai') : ?>
                                            <div class="badge bg-success"><?= $t['status']; ?></div>
                                        <?php else : ?>
                                            <div class="badge bg-secondary"><?= $t['status']; ?></div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="/tamu/edit/<?= $t['id_tamu'] ?>" class="btn text-center yellow-bg text-white fw-bold">
                                            Edit
                                        </a>
                                        <a href="/tamu/delete/<?= $t['id_tamu'] ?>" class="btn btn-danger text-center fw-bold tampilDeleteTamu" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $t['id_tamu'] ?>">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?= $pager->links('tamu', 'custom_pagination'); ?>
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
                <form action="/tamu/delete" method="post">
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