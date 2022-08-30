<?php

namespace App\Controllers;

use App\Models\PenilaianModel;

class Penilaian extends BaseController
{

    protected $penilaianModel;

    public function __construct()
    {
        $this->penilaianModel = new PenilaianModel();
    }

    public function index()
    {

        $data = [
            'title' => 'Penilaian',
            'validation' => \Config\Services::validation()
        ];

        return view('/penilaian/index', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'option' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukan penilaian anda terlebih dahulu',
                ]
            ],
        ])) {
            return redirect()->to('http://localhost:8080/penilaian')->withInput();
        }

        $this->penilaianModel->save(
            [
                'kategori_penilaian' => $this->request->getVar('option')
            ]
        );

        session()->setFlashdata('pesan', 'Terima kasih telah berkunjung, penilaian anda berhasil dikirim');
        return redirect()->to('http://localhost:8080/penilaian');
    }
}
