<div class="bg-white shadow" id="sidebar-wrapper">
    <div class="sidebar-heading text-center primary-bg py-3 text-white fs-6 fw-bold text-uppercase">
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <img src="/img/iconcamat.png" alt="icon" width="50" height="50">
                <h5 class="fw-bold fs-3 ms-2 mt-2">MENU</h5>
            </div>
        </div>
    </div>
    <div class="list-group list-group-flush my-3">
        <a href="/home-admin" class="list-group-item list-group-item-action bg-transparent second-text fw-bold <?= ($activeMenu == 'home') ? 'active' : '' ?>"><i class="fas fa-home me-2"></i>Home</a>
        <a href="/admin" class="list-group-item list-group-item-action bg-transparent second-text fw-bold <?= ($activeMenu == 'admin') ? 'active' : '' ?>"><i class="fas fa-user me-2"></i>Data Admin</a>
        <a href="/pegawai" class="list-group-item list-group-item-action bg-transparent second-text fw-bold <?= ($activeMenu == 'pegawai') ? 'active' : '' ?>"><i class="fas fa-users me-2"></i>Data Pegawai</a>
        <a href="/jabatan" class="list-group-item list-group-item-action bg-transparent second-text fw-bold <?= ($activeMenu == 'jabatan') ? 'active' : '' ?>"><i class="fas fa-book-open me-2"></i>Data Jabatan</a>
        <a href="/tamu" class="list-group-item list-group-item-action bg-transparent second-text fw-bold <?= ($activeMenu == 'tamu') ? 'active' : '' ?>"><i class="fas fa-book me-2"></i>Data Tamu</a>
        <a href="" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold" data-bs-toggle="modal" data-bs-target="#logoutModal"><i class="fas fa-power-off me-2"></i>Logout</a>
    </div>
</div>