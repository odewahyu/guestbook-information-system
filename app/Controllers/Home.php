<?php

namespace App\Controllers;

use App\Models\PenilaianModel;
use App\Models\AdminModel;
use App\Models\PegawaiModel;
use App\Models\TamuModel;

class Home extends BaseController
{

    protected $penilaianModel;
    protected $adminModel;
    protected $pegawaiModel;
    protected $tamuModel;

    public function __construct()
    {
        $this->penilaianModel = new PenilaianModel();
        $this->adminModel = new AdminModel();
        $this->pegawaiModel = new PegawaiModel();
        $this->tamuModel = new TamuModel();
    }

    public function homeAdmin()
    {
        $tahun = date('Y');
        $hasilPenilaian = $this->penilaianModel->hasilPenilaian();
        $keperluan = $this->tamuModel->getKeperluan();
        $tamuBulanan = $this->tamuModel->getTamuBulanan($tahun);

        $jmlAdmin = $this->adminModel->countAllResults();
        $jmlPegawai = $this->pegawaiModel->countAllResults();
        $jmlTamu = $this->tamuModel->getJumlahTamu()[0]['jml'];

        $jmlTamuPerHari = $this->tamuModel->getTamuPerHari(date('Y-m-d'))[0]['jml'];

        $data = [
            'title' => 'Home',
            'activeMenu' => 'home',
            'hasilPenilaian' => $hasilPenilaian,
            'keperluan' => $keperluan,
            'tamuBulanan' => $tamuBulanan,
            'jumlahAdmin' => $jmlAdmin,
            'jumlahPegawai' => $jmlPegawai,
            'jumlahTamu' => $jmlTamu,
            'jumlahTamuPerHari' => $jmlTamuPerHari,
        ];

        return view('/home/homeadmin', $data);
    }

    public function homePegawai()
    {

        $data = [
            'title' => 'Home',
            'activeMenu' => 'home',
        ];

        return view('/home/homepegawai', $data);
    }
}
