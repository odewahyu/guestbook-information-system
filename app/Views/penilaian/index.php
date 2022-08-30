<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid third-bg">
    <div class="row d-flex justify-content-center align-items-center">
        <div class=" col-8 bg-body px-3 py-4 shadow my-5">
            <div class="col-12 d-flex justify-content-center mb-2">
                <h3 class="fw-bold third-text text-center">SISTEM INFORMASI BUKU TAMU KANTOR CAMAT MENGWI</h3>
            </div>
            <div class="col-12 d-flex justify-content-center mb-2">
                <img src="/img/iconcamat.png" alt="icon" width="199" height="200">
            </div>
            <h5 class="fw-bold mb-3 third-text text-center">Silahkan Beri Penilaian Atas Pelayanan Kami</h5>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="col-12">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashData('pesan'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            <?php endif; ?>
            <hr>
            <form action="/penilaian/save" method="post">
                <div class="row d-flex justify-content-center">
                    <div class='col-auto'>
                        <input type="radio" class="btn-check <?= ($validation->hasError('option')) ? 'is-invalid' : ''; ?>" name="option" id="option1" value="Sangat Puas" autocomplete="off">
                        <label class="btn btn-success" for="option1">
                            <div class="col-size icon-size">
                                <i class="fa far fa-smile-beam"></i>
                            </div>
                        </label>
                        <h5 class="fs-6 mt-1 text-center third-text fw-bold">Sangat Puas</h5>
                    </div>
                    <div class='col-auto'>
                        <input type="radio" class="btn-check <?= ($validation->hasError('option')) ? 'is-invalid' : ''; ?>" name="option" id="option2" value="Puas" autocomplete="off">
                        <label class="btn btn-primary" for="option2">
                            <div class="col-size icon-size">
                                <i class="fa far fa-smile"></i>
                            </div>
                        </label>
                        <h5 class="fs-6 mt-1 text-center third-text fw-bold">Puas</h5>
                    </div>
                    <div class='col-auto'>
                        <input type="radio" class="btn-check" name="option <?= ($validation->hasError('option')) ? 'is-invalid' : ''; ?>" id="option3" value="Tidak Puas" autocomplete="off">
                        <label class="btn btn-warning text-white" for="option3">
                            <div class="col-size icon-size">
                                <i class="fa far fa-frown"></i>
                            </div>
                        </label>
                        <h5 class="fs-6 mt-1 text-center third-text fw-bold">Tidak Puas</h5>
                    </div>
                    <div class='col-auto'>
                        <input type="radio" class="btn-check <?= ($validation->hasError('option')) ? 'is-invalid' : ''; ?>" name="option" id="option4" value="Sangat Tidak Puas" autocomplete="off">
                        <label class="btn btn-danger" for="option4">
                            <div class="col-size icon-size">
                                <i class="fa far fa-angry"></i>
                            </div>
                        </label>
                        <h5 class="fs-6 mt-1 text-center third-text fw-bold">Sangat Tidak Puas</h5>
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <div class="text-danger">
                            <?= $validation->getError('option'); ?>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-4 d-flex justify-content-center">
                    <button type="submit" class="btn radius col-11 p-3 secondary-bg text-white fs-4 fw-bold">
                        Beri Penilaian
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>