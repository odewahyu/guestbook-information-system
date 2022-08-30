<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="d-flex" id="wrapper">

    <?= $this->include('/layout/sidebarpegawai'); ?>

    <div id="page-content-wrapper">

        <?= $this->include('/layout/navbar'); ?>

        <div class="container-fluid px-4">
            <div class="row">
                <?php if (session()->getFlashdata('pesan')) : ?>
                    <div class="col-6">
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
                            <?php foreach ($jadwalTamu as $jd) : ?>

                                <tr class="align-middle">
                                    <th class="text-center" scope="row"><?= $i; ?>.</th>
                                    <td><?= $jd['nama_lengkap']; ?></td>
                                    <td><?= $jd['instansi']; ?></td>
                                    <td><?= $jd['tanggal_kunjungan']; ?></td>
                                    <td><?= $jd['jam_kunjungan']; ?></td>
                                    <td><?= $jd['ruang_kunjungan']; ?></td>
                                    <td>
                                        <a href="/jadwal/editstatus/<?= $jd['id_tamu'] ?>" class="btn text-center btn-success fw-bold tampilSelesaiJadwal" data-bs-toggle="modal" data-bs-target="#editStatusModal" data-id="<?= $jd['id_tamu']; ?>">
                                            Selesai
                                        </a>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?= $pager->links('jadwal', 'custom_pagination'); ?>
                </div>
            </div>
        </div>

    </div>

</div>

<div class="modal fade" id="editStatusModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="exampleModalLabel">Selesai Kunjungan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/jadwal/editstatus" method="post">
                    <input type="hidden" name="id_selesai" id="id_selesai">
                    Apakah kunjungan tamu telah selesai?
            </div>
            <div class="modal-footer">
                <button type="button" class="fw-bold btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button class="fw-bold btn btn-success" type="submit">Selesai</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->include('/layout/modals/logoutModal') ?>

<?= $this->endSection(); ?>