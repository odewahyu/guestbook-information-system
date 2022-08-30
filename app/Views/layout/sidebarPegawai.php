<div class="bg-white shadow" id="sidebar-wrapper">
    <div class="sidebar-heading text-center primary-bg py-3 primary-text text-white fs-6 fw-bold text-uppercase">
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <img src="/img/iconcamat.png" alt="icon" width="50" height="50">
                <h5 class="fw-bold fs-3 ms-2 mt-2">MENU</h5>
            </div>
        </div>
    </div>
    <div class="list-group list-group-flush my-3">
        <a href="/home-pegawai" class="list-group-item list-group-item-action bg-transparent second-text fw-bold <?= ($activeMenu == 'home') ? 'active' : '' ?>"><i class="fas fa-home me-2"></i>Home</a>
        <a href="/jadwal" class="list-group-item list-group-item-action bg-transparent second-text fw-bold <?= ($activeMenu == 'jadwal') ? 'active' : '' ?>"><i class="fas fa-calendar me-2"></i>Jadwal</a>
        <a href="/permintaan" class="list-group-item list-group-item-action bg-transparent second-text fw-bold <?= ($activeMenu == 'permintaan') ? 'active' : '' ?>"><i class="fas fa-clipboard-list me-2"></i>Permintaan</a>
        <a href="" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold" data-bs-toggle="modal" data-bs-target="#logoutModal"><i class="fas fa-power-off me-2"></i>Logout</a>
    </div>
</div>