<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="d-flex" id="wrapper">

    <?= $this->include('/layout/sidebarpegawai'); ?>

    <div id="page-content-wrapper">

        <?= $this->include('/layout/navbar'); ?>

        <div class="container-fluid px-3">
            <div class="row secondary-bg px-5 mx-2 rounded shadow">
                <div class="col-lg-4 mt-3 d-flex justify-content-center align-items-center">
                    <i class="fas fa-user icon-size text-white"></i>
                </div>
                <div class="col-lg-8 mt-3">
                    <div class="px-2 pt-3 pb-2 secondary-bg">
                        <h3 class="px-2 fw-bold text-white">Profile Pegawai</h3>
                        <table class="table table-borderless">
                            <tbody class="text-white">
                                <tr>
                                    <td>Username</td>
                                    <td>:</td>
                                    <td><?= session()->get('username_pegawai') ?></td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td><?= session()->get('nama_pegawai') ?></td>
                                </tr>
                                <tr>
                                    <td>E-mail</td>
                                    <td>:</td>
                                    <td><?= session()->get('email_pegawai') ?></td>
                                </tr>
                                <tr>
                                    <td>No. Telephone</td>
                                    <td>:</td>
                                    <td><?= session()->get('no_telp_pegawai') ?></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td><?= session()->get('alamat_pegawai') ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<?= $this->include('/layout/modals/logoutModal') ?>

<?= $this->endSection(); ?>