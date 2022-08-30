<?php

namespace App\Controllers;

use App\Models\TamuModel;

class Jadwal extends BaseController
{

    protected $tamuModel;

    public function __construct()
    {
        $this->tamuModel = new TamuModel();
    }


    public function index()
    {
        $date = $this->request->getVar('tanggal');
        $all = $this->request->getVar('showall');
        $search = $this->request->getVar('search');
        $idPegawai = session()->get('id_pegawai');

        $jadwalTamu = $this->tamuModel
            ->where('id_pegawai', $idPegawai)
            ->where('status', 'Diterima');

        if (isset($search)) {
            $jadwalTamu = $this->tamuModel
                ->where([
                    'id_pegawai' => $idPegawai,
                    'status' => 'Diterima',
                    'tanggal_kunjungan' => $date
                ]);
        }

        if (isset($all)) {
            $jadwalTamu = $this->tamuModel
                ->where('id_pegawai', $idPegawai)
                ->where('status', 'Diterima');
        }

        $currentPage = $this->request->getVar('page_jadwal') ? $this->request->getVar('page_jadwal') : 1;

        $data = [
            'title' => 'Jadwal',
            'activeMenu' => 'jadwal',
            'jadwalTamu' => $jadwalTamu->paginate(10, 'jadwal'),
            'pager' => $this->tamuModel->pager,
            'currentPage' => $currentPage
        ];

        return view('/jadwal/index', $data);
    }

    public function editStatus()
    {
        $id = $this->request->getVar('id_selesai');

        $this->tamuModel->save([
            'id_tamu' => $id,
            'status' => 'Selesai'
        ]);

        session()->setFlashdata('pesan', 'Anda telah menyelesaikan pertemuan dengan tamu');
        return redirect()->to('http://localhost:8080/jadwal');
    }
}
