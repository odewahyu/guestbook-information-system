<?php

namespace App\Controllers;

use App\Models\PegawaiModel;
use App\Models\JabatanModel;

class Pegawai extends BaseController
{

    protected $pegawaiModel;
    protected $jabatanModel;

    public function __construct()
    {
        $this->pegawaiModel = new PegawaiModel();
        $this->jabatanModel = new JabatanModel();
    }

    public function index()
    {
        $keywordData = $this->request->getVar();
        $keyword = '';

        if (isset($keywordData) && isset($keywordData['keyword'])) {
            $keyword = $keywordData['keyword'];
            session()->set('caripegawai', $keyword);
        } else {
            $keyword = session()->get('caripegawai');
        }

        if ($keyword == '') {
            $pegawai = $this->pegawaiModel->getPaginate(10);
        } else {
            $pegawai = $this->pegawaiModel->getSearchPaginate(10, $keyword);
        }

        $currentPage = $this->request->getVar('page_pegawai') ? $this->request->getVar('page_pegawai') : 1;

        $data = [
            'title' => 'Data Pegawai',
            'activeMenu' => 'pegawai',
            'pegawai' => $pegawai,
            'pager' => $this->pegawaiModel->pager,
            'currentPage' => $currentPage,
        ];

        return view('/pegawai/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Pegawai',
            'activeMenu' => 'pegawai',
            'jabatan' => $this->jabatanModel->getJabatan(),
            'validation' => \Config\Services::validation()
        ];

        return view('pegawai/create', $data);
    }

    public function save()
    {
        $pegawaiPassword = $this->request->getVar('password');
        $pegawaiPassword = password_hash($pegawaiPassword, PASSWORD_DEFAULT);

        if (!$this->validate([
            'username' => [
                'rules' => 'required|is_unique[pegawai.username]|alpha_numeric',
                'errors' => [
                    'required' => 'Username tidak boleh kosong',
                    'is_unique' => 'Username sudah terdaftar',
                    'alpha_numeric' => 'Usernama tidak boleh berisi spasi'
                ]
            ],
            'nama_lengkap' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong',
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password tidak boleh kosong',
                ]
            ],
            'email' => [
                'rules' => 'required|is_unique[pegawai.email]|valid_email',
                'errors' => [
                    'required' => 'Email tidak boleh kosong',
                    'is_unique' => 'Email sudah terdaftar',
                    'valid_email' => 'Email harus berisi "@"'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat tidak boleh kosong',
                ]
            ],
            'no_telp' => [
                'rules' => 'required|is_unique[pegawai.no_telephone]',
                'errors' => [
                    'required' => 'No. Telephone tidak boleh kosong',
                    'is_unique' => 'No. Telephone sudah terdaftar'
                ]
            ]
        ])) {
            return redirect()->to('http://localhost:8080/pegawai/create')->withInput();
        }

        $this->pegawaiModel->save([
            'id_jabatan' => $this->request->getVar('jabatan'),
            'username' => $this->request->getVar('username'),
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'password' => $pegawaiPassword,
            'email' => $this->request->getVar('email'),
            'alamat' => $this->request->getVar('alamat'),
            'no_telephone' => $this->request->getVar('no_telp')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('http://localhost:8080/pegawai');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data Pegawai',
            'activeMenu' => 'pegawai',
            'pegawai' => $this->pegawaiModel->find($id),
            'jabatan' => $this->jabatanModel->getJabatan(),
            'validation' => \Config\Services::validation()
        ];

        return view('pegawai/edit', $data);
    }

    public function update()
    {
        $dataLama = $this->pegawaiModel->find($this->request->getVar('id'));

        $pegawaiPassword = $this->request->getVar('password');

        if ($pegawaiPassword == '') {
            $pegawaiPassword = $dataLama['password'];
        } else {
            $pegawaiPassword = password_hash($pegawaiPassword, PASSWORD_DEFAULT);
        }

        if ($dataLama['username'] == $this->request->getVar('username')) {
            $ruleUsername = 'required|alpha_numeric';
        } else {
            $ruleUsername = 'required|is_unique[pegawai.username]|alpha_numeric';
        }

        if ($dataLama['email'] == $this->request->getVar('email')) {
            $ruleEmail = 'required|valid_email';
        } else {
            $ruleEmail = 'required|is_unique[pegawai.email]|valid_email';
        }

        if ($dataLama['no_telephone'] == $this->request->getVar('no_telp')) {
            $ruleTelephone = 'required';
        } else {
            $ruleTelephone = 'required|is_unique[pegawai.no_telephone]';
        }

        if (!$this->validate([
            'username' => [
                'rules' => $ruleUsername,
                'errors' => [
                    'required' => 'Username tidak boleh kosong',
                    'is_unique' => 'Username sudah terdaftar',
                    'alpha_numeric' => 'Usernama tidak boleh berisi spasi'
                ]
            ],
            'nama_lengkap' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong',
                ]
            ],
            'email' => [
                'rules' => $ruleEmail,
                'errors' => [
                    'required' => 'Email tidak boleh kosong',
                    'is_unique' => 'Email sudah terdaftar',
                    'valid_email' => 'Email harus berisi "@"'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat tidak boleh kosong',
                ]
            ],
            'no_telp' => [
                'rules' => $ruleTelephone,
                'errors' => [
                    'required' => 'No. Telephone tidak boleh kosong',
                    'is_unique' => 'No. Telephone sudah terdaftar'
                ]
            ],
        ])) {
            return redirect()->to('http://localhost:8080/pegawai/edit/' . $this->request->getVar('id'))->withInput();
        }

        $this->pegawaiModel->save([
            'id_pegawai' => $this->request->getVar('id'),
            'id_jabatan' => $this->request->getVar('jabatan'),
            'username' => $this->request->getVar('username'),
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'password' => $pegawaiPassword,
            'email' => $this->request->getVar('email'),
            'alamat' => $this->request->getVar('alamat'),
            'no_telephone' => $this->request->getVar('no_telp')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('http://localhost:8080/pegawai');
    }

    public function delete()
    {
        $id = $this->request->getVar('id_delete');

        $this->pegawaiModel->delete($id);

        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('http://localhost:8080/pegawai');
    }
}
