<?php

use App\Models\TamuModel;

$model = new TamuModel();

if (session()->get('logged_in_pegawai') == true) {
    $tamu = $model->where('id_pegawai', session()->get('id_pegawai'))
        ->where('status', '-')
        ->get()
        ->getResultArray();
    $jmlTamu = $model->select('COUNT(id_tamu) as jml')
        ->where('id_pegawai', session()->get('id_pegawai'))
        ->where('status', '-')
        ->get()
        ->getResultArray();
}

if (session()->get('logged_in_admin') == true) {
    $tamu = $model->where('status', '-')
        ->get()
        ->getResultArray();
    $jmlTamu = $model->select('COUNT(id_tamu) as jml')
        ->where('status', '-')
        ->get()
        ->getResultArray();
}
?>

<nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
    <div class="d-flex align-items-center justify-content-space-around">
        <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
        <h2 class="fs-5 m-0 third-text fw-bold">SISTEM INFORMASI BUKU TAMU KANTOR CAMAT MENGWI</h2>
    </div>


    <div class="navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item dropdown third-text">
                <a class="nav-link dropdown-toggle third-text fw-bold d-flex justify-content-start align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-bell me-1"></i>
                    <span class="bg-danger text-white px-1 rounded notification-text"><?= $jmlTamu[0]['jml']; ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end bg-body" aria-labelledby="navbarDropdown">
                    <?php if ($jmlTamu[0]['jml'] == 0) : ?>
                        <li class="fs-6 text-center third-text">
                            Tidak ada permintaan kunjungan
                        </li>
                    <?php endif; ?>
                    <?php foreach ($tamu as $t) : ?>
                        <li>
                            <a class="dropdown-item fw-bold third-text fs-6">
                                <i class="fas fa-user me-1"></i>
                                <?= $t['nama_lengkap'] ?>
                                <h6 class="fs-6 second-text">
                                    Tamu mengirim permintaan kunjungan
                                </h6>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>

        </ul>
    </div>
</nav>