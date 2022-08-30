<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="d-flex" id="wrapper">

    <?= $this->include('/layout/sidebar'); ?>

    <div id="page-content-wrapper">

        <?= $this->include('/layout/navbar'); ?>

        <div class="container-fluid px-3">
            <div class="row primary-bg px-5 mx-2 rounded shadow">
                <div class="col-lg-4 mt-3 d-flex justify-content-center align-items-center">
                    <i class="fas fa-user icon-size text-white"></i>
                </div>
                <div class="col-lg-8 mt-3">
                    <div class="px-2 pt-3 pb-2 primary-bg">
                        <h3 class="px-2 fw-bold text-white">Profile Admin</h3>
                        <table class="table table-borderless">
                            <tbody class="text-white">
                                <tr>
                                    <td>Username</td>
                                    <td>:</td>
                                    <td><?= session()->get('username_admin') ?></td>
                                </tr>
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td><?= session()->get('nama_admin') ?></td>
                                </tr>
                                <tr>
                                    <td>E-mail</td>
                                    <td>:</td>
                                    <td><?= session()->get('email_admin') ?></td>
                                </tr>
                                <tr>
                                    <td>No. Telephone</td>
                                    <td>:</td>
                                    <td><?= session()->get('no_telp_admin') ?></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>:</td>
                                    <td><?= session()->get('alamat_admin') ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row mx-2 my-3">
                <div class="col-6">
                    <div class="row">
                        <div class="col-5 secondary-bg me-2 rounded shadow px-3 py-5 d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="fs-5 text-white fw-bold">Admin</h5>
                                <h5 class="fs-6 text-white fw-bold"><?= $jumlahAdmin; ?></h5>
                            </div>
                            <i class="fas fa-user fs-1 text-white"></i>
                        </div>
                        <div class="col-5 bg-danger rounded shadow px-3 py-5 d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="fs-5 text-white fw-bold">Pegawai</h5>
                                <h5 class="fs-6 text-white fw-bold"><?= $jumlahPegawai; ?></h5>
                            </div>
                            <i class="fas fa-user-friends fs-1 text-white"></i>
                        </div>
                        <div class="col-5 primary-bg me-2 rounded shadow px-3 py-5 mt-2 d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="fs-5 text-white fw-bold">Tamu Hari Ini</h5>
                                <h5 class="fs-6 text-white fw-bold"><?= $jumlahTamuPerHari; ?></h5>
                            </div>
                            <i class="fas fa-users fs-1 text-white"></i>
                        </div>
                        <div class="col-5 bg-success rounded shadow px-3 py-5 mt-2 d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="fs-5 text-white fw-bold">Total Tamu</h5>
                                <h5 class="fs-6 text-white fw-bold"><?= $jumlahTamu; ?></h5>
                            </div>
                            <i class="fas fa-book me-2 fs-1 text-white"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 shadow bg-body rounded d-flex align-items-center">
                    <canvas id="kepuasanChart" width="" height=""></canvas>
                </div>
            </div>
            <div class="row mx-2 my-3 d-flex justify-content-between">
                <div class="col-4 shadow bg-body rounded d-flex align-items-center p-3">
                    <canvas id="kategoriChart" width="50" height="50"></canvas>
                </div>
                <div class="col-7 shadow bg-body rounded p-3">
                    <canvas id="bulananChart" width="100" height=""></canvas>
                </div>
            </div>
        </div>

    </div>

</div>

<script>
    const kepuasanChart = document.getElementById('kepuasanChart');
    var jumlahPerNilai = [];
    var nilai = [];

    <?php foreach ($hasilPenilaian as $value) : ?>
        jumlahPerNilai.push(<?= $value->jml ?>);
        nilai.push('<?= $value->pnl ?>');
    <?php endforeach ?>

    const myChart4 = new Chart(kepuasanChart, {
        type: 'bar',
        data: {
            labels: nilai,
            datasets: [{
                label: 'Jumlah',
                data: jumlahPerNilai,
                backgroundColor: [
                    'rgba(0, 216, 196, 0.5)'
                ],
                borderColor: [
                    'rgba(0, 216, 196, 1)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Penilaian Pelayanan'
                }
            }
        }
    });

    const kategoriChart = document.getElementById('kategoriChart');
    var jumlahPerKeperluan = [];
    var keperluanLabel = [];

    <?php foreach ($keperluan as $value) : ?>
        jumlahPerKeperluan.push(<?= $value->jml ?>);
        keperluanLabel.push('<?= $value->kpr ?>');
    <?php endforeach ?>

    const myChart1 = new Chart(kategoriChart, {
        type: 'doughnut',
        data: {
            labels: keperluanLabel,
            datasets: [{
                label: 'Jumlah Tamu Berdasarkan Keperluan',
                data: jumlahPerKeperluan,
                backgroundColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Jumlah Tamu Berdasarkan Keperluan'
                }
            }
        }
    });

    const bulananChart = document.getElementById('bulananChart');
    var jumlahPerBulan = [];
    var bulan = [];

    <?php foreach ($tamuBulanan as $value) : ?>
        jumlahPerBulan.push(<?= $value->jml ?>);
        bulan.push('<?= $value->bulan ?>');
    <?php endforeach ?>

    const myChart3 = new Chart(bulananChart, {
        type: 'line',
        data: {
            labels: bulan,
            datasets: [{
                data: jumlahPerBulan,
                label: 'Jumlah',
                backgroundColor: 'rgba(248, 129, 70, 1)',
                borderColor: 'rgba(248, 129, 70, 1)',
                borderWidth: 2
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Jumlah Tamu Per Bulan'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<?= $this->include('/layout/modals/logoutModal') ?>

<?= $this->endSection(); ?>