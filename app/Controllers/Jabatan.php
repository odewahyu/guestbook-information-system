<?php

namespace App\Controllers;

use App\Models\JabatanModel;

class Jabatan extends BaseController
{
    protected $jabatanModel;

    public function __construct()
    {
        $this->jabatanModel = new JabatanModel();
    }

    public function index()
    {
        $keywordData = $this->request->getVar();
        $keyword = '';

        if (isset($keywordData) && isset($keywordData['keyword'])) {
            $keyword = $keywordData['keyword'];
            session()->set('carijabatan', $keyword);
        } else {
            $keyword = session()->get('carijabatan');
        }

        if ($keyword == '') {
            $jabatan = $this->jabatanModel->paginate(10, 'jabatan');
        } else {
            $jabatan = $this->jabatanModel->search($keyword)->paginate(10, 'jabatan');
        }

        $currentPage = $this->request->getVar('page_jabatan') ? $this->request->getVar('page_jabatan') : 1;

        $data = [
            'title' => 'Data Jabatan',
            'activeMenu' => 'jabatan',
            'jabatan' => $jabatan,
            'pager' => $this->jabatanModel->pager,
            'currentPage' => $currentPage,
        ];

        return view('/jabatan/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Jabatan',
            'activeMenu' => 'jabatan',
            'validation' => \Config\Services::validation()
        ];

        return view('jabatan/create', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'nama_jabatan' => [
                'rules' => 'required|is_unique[jabatan.nama_jabatan]',
                'errors' => [
                    'required' => 'Nama jabatan tidak boleh kosong',
                    'is_unique' => 'Nama jabatan sudah terdaftar'
                ]
            ]
        ])) {
            return redirect()->to('http://localhost:8080/jabatan/create')->withInput();
        }

        $this->jabatanModel->save([
            'nama_jabatan' => $this->request->getVar('nama_jabatan'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('http://localhost:8080/jabatan');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Tambah Data Jabatan',
            'activeMenu' => 'jabatan',
            'jabatan' => $this->jabatanModel->find($id),
            'validation' => \Config\Services::validation()
        ];

        return view('jabatan/edit', $data);
    }

    public function update()
    {
        $dataLama = $this->jabatanModel->find($this->request->getVar('id'));

        if ($dataLama['nama_jabatan'] == $this->request->getVar('nama_jabatan')) {
            $ruleJabatan = 'required';
        } else {
            $ruleJabatan = 'required|is_unique[jabatan.nama_jabatan]';
        }

        if (!$this->validate([
            'nama_jabatan' => [
                'rules' => $ruleJabatan,
                'errors' => [
                    'required' => 'Nama jabatan tidak boleh kosong',
                    'is_unique' => 'Nama jabatan sudah terdaftar'
                ]
            ]
        ])) {
            return redirect()->to('http://localhost:8080/jabatan/edit/' . $this->request->getVar('id'))->withInput();
        }

        $this->jabatanModel->save([
            'id_jabatan' => $this->request->getVar('id'),
            'nama_jabatan' => $this->request->getVar('nama_jabatan'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('http://localhost:8080/jabatan');
    }

    public function delete()
    {
        $id = $this->request->getVar('id_delete');

        $this->jabatanModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('http://localhost:8080/jabatan');
    }
}
