<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="d-flex" id="wrapper">

    <?= $this->include('/layout/sidebarpegawai'); ?>

    <div id="page-content-wrapper">

        <?= $this->include('/layout/navbar'); ?>

        <div class="container-fluid px-4">
            <div class="row">
                <?php if (session()->getFlashdata('pesan')) : ?>
                    <div class="col-auto">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= session()->getFlashData('pesan'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <form action="" method="post">
                <div class="row d-flex align-items-center justify-content-start">
                    <div class="col-2 mt-3">
                        <input type="date" value="<?= date('Y-m-d'); ?>" name="tanggal" class="form-control p-2" autocomplete="off">
                    </div>
                    <button class="btn text-white primary-bg col-1 mt-3 p-2 me-1 fw-bold" type="submit" name="search">
                        Search
                    </button>
                    <button class="btn text-white yellow-bg col-2 mt-3 p-2 fw-bold" type="submit" name="showall">
                        Show All
                    </button>
                </div>
            </form>
            <div class="row my-3">
                <div class="col-md table-responsive">
                    <table class="table table-hover bg-white rounded-2 shadow-sm">
                        <thead class="secondary-bg text-white">
                            <tr>
                                <th class="text-center" scope="col">No.</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Instansi</th>
                                <th scope="col">Tanggal Kunjungan</th>
                                <th scope="col">Jam Kunjungan</th>
                                <th scope="col">Ruangan</th>
                                <th scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 + (1 * ($currentPage - 1)); ?>
                            <?php foreach ($permintaanTamu as $pm) : ?>

                                <tr class="align-middle">
                                    <th class="text-center" scope="row"><?= $i; ?>.</th>
                                    <td><?= $pm['nama_lengkap']; ?></td>
                                    <td><?= $pm['instansi']; ?></td>
                                    <td><?= $pm['tanggal_kunjungan']; ?></td>
                                    <td><?= $pm['jam_kunjungan']; ?></td>
                                    <td><?= $pm['ruang_kunjungan']; ?></td>
                                    <td>
                                        <a href="/permintaan/terima/<?= $pm['id_tamu'] ?>" class="btn text-center text-white primary-bg fw-bold tampilTerimaTamu" data-bs-toggle="modal" data-bs-target="#terimaModal" data-id="<?= $pm['id_tamu']; ?>">
                                            Terima
                                        </a>
                                        <a href="/permintaan/tolak/<?= $pm['id_tamu'] ?>" class="btn text-center btn-danger fw-bold tampilTolakTamu" data-bs-toggle="modal" data-bs-target="#tolakModal" data-id="<?= $pm['id_tamu']; ?>">
                                            Tolak
                                        </a>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?= $pager->links('permintaan', 'custom_pagination'); ?>
                </div>
            </div>
        </div>

    </div>

</div>

<div class="modal fade" id="tolakModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="exampleModalLabel">Tolak Kunjungan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/permintaan/tolak" method="post">
                    <input type="hidden" name="id_tolak" id="id_tolak">
                    Apakah anda akan menolak kunjungan tamu?
            </div>
            <div class="modal-footer">
                <button type="button" class="fw-bold btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button class="fw-bold btn btn-danger" type="submit">Tolak</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="terimaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="exampleModalLabel">Terima Kunjungan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/permintaan/terima" method="post">
                    <input type="hidden" name="id_terima" id="id_terima">
                    Apakah anda akan menerima kunjungan tamu?
            </div>
            <div class="modal-footer">
                <button type="button" class="fw-bold btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button class="fw-bold btn text-white primary-bg" type="submit">Terima</button>
            </div>
            </form>
        </div>
    </div>
</div>

<?= $this->include('/layout/modals/logoutModal') ?>

<?= $this->endSection(); ?>