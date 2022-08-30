<?php

namespace App\Controllers;

use App\Models\TamuModel;

class FormKunjunganTamu extends BaseController
{
    protected $tamuModel;

    public function __construct()
    {
        $this->tamuModel = new TamuModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Form Kunjungan Tamu',
            'validation' => \Config\Services::validation(),
        ];

        return view('/formkunjungantamu/index', $data);
    }

    public function save()
    {
        $nama = $this->request->getVar('nama_lengkap');
        $keperluan = $this->request->getVar('keperluan');
        $email = $this->request->getVar('email');
        $tgl_kunjungan = $this->request->getVar('tgl_kunjungan');
        $jam_kunjungan = $this->request->getVar('jam_kunjungan');
        $instansi = $this->request->getVar('instansi');

        if ($keperluan == 'Bertemu Camat') {
            $idPegawai = 1;
            $ruangKunjungan = 'Camat';
            $status = '-';
        } else if ($keperluan == 'Bertemu Ketua Sekretariat') {
            $idPegawai = 3;
            $ruangKunjungan = 'Sekretariat';
            $status = '-';
        } else if ($keperluan == 'Membuat KTP') {
            $idPegawai = 0;
            $ruangKunjungan = 'Pelayanan Umum';
            $status = 'Diterima';
        } else {
            $idPegawai = 0;
            $ruangKunjungan = '-';
            $status = 'Diterima';
        }

        if ($email == '') {
            $email = '-';
        }

        if ($tgl_kunjungan == '') {
            $tgl_kunjungan = date('Y-m-d');
        }

        if ($jam_kunjungan == '') {
            date_default_timezone_set('Asia/Makassar');
            $jam_kunjungan = date('H:i:s', time());
        }

        if ($instansi == '') {
            $instansi = '-';
        }

        if (!$this->validate([
            'nama_lengkap' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong',
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat tidak boleh kosong',
                ]
            ],
            'no_telp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'No. telephone tidak boleh kosong',

                ]
            ],
        ])) {
            return redirect()->to('http://localhost:8080/formkunjungantamu')->withInput();
        }

        $this->tamuModel->save([
            'id_pegawai' => $idPegawai,
            'nama_lengkap' => $nama,
            'email' => $email,
            'no_telephone' => $this->request->getVar('no_telp'),
            'alamat' => $this->request->getVar('alamat'),
            'instansi' => $instansi,
            'keperluan' => $keperluan,
            'tanggal_kunjungan' => $tgl_kunjungan,
            'jam_kunjungan' => $jam_kunjungan,
            'ruang_kunjungan' => $ruangKunjungan,
            'status' => $status,
        ]);

        session()->setFlashdata('pesan', 'Data anda berhasil dikirim');
        return redirect()->to('http://localhost:8080/formkunjungantamu');
    }
}
