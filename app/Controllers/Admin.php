<?php

namespace App\Controllers;

use App\Models\AdminModel;

class Admin extends BaseController
{
    protected $adminModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
    }

    public function index()
    {
        $keywordData = $this->request->getVar();
        $keyword = '';

        if (isset($keywordData) && isset($keywordData['keyword'])) {
            $keyword = $keywordData['keyword'];
            session()->set('cariadmin', $keyword);
        } else {
            $keyword = session()->get('cariadmin');
        }

        if ($keyword == '') {
            $admin = $this->adminModel->paginate(10, 'admin');
        } else {
            $admin = $this->adminModel->search($keyword)->paginate(10, 'admin');
        }

        $currentPage = $this->request->getVar('page_admin') ? $this->request->getVar('page_admin') : 1;

        $data = [
            'title' => 'Data Admin',
            'activeMenu' => 'admin',
            'admin' => $admin,
            'pager' => $this->adminModel->pager,
            'currentPage' => $currentPage,
        ];

        return view('admin/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Admin',
            'activeMenu' => 'admin',
            'validation' => \Config\Services::validation()
        ];

        return view('admin/create', $data);
    }

    public function save()
    {

        $adminPassword = $this->request->getVar('password');
        $adminPassword = password_hash($adminPassword, PASSWORD_DEFAULT);

        if (!$this->validate([
            'username' => [
                'rules' => 'required|is_unique[admin.username]|alpha_numeric',
                'errors' => [
                    'required' => 'Username tidak boleh kosong',
                    'is_unique' => 'Username sudah terdaftar',
                    'alpha_numeric' => 'Username tidak boleh berisi spasi'
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
                'rules' => 'required|is_unique[admin.email]|valid_email',
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
                'rules' => 'required|is_unique[admin.no_telephone]',
                'errors' => [
                    'required' => 'No. Telephone tidak boleh kosong',
                    'is_unique' => 'No. Telephone sudah terdaftar',
                ]
            ]
        ])) {
            return redirect()->to('http://localhost:8080/admin/create')->withInput();
        }

        $this->adminModel->save([
            'username' => $this->request->getVar('username'),
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'password' => $adminPassword,
            'email' => $this->request->getVar('email'),
            'alamat' => $this->request->getVar('alamat'),
            'no_telephone' => $this->request->getVar('no_telp')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('http://localhost:8080/admin');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data Admin',
            'activeMenu' => 'admin',
            'admin' => $this->adminModel->find($id),
            'validation' => \Config\Services::validation()
        ];

        return view('admin/edit', $data);
    }

    public function update()
    {
        $dataLama = $this->adminModel->find($this->request->getVar('id'));

        $adminPassword = $this->request->getVar('password');

        if ($adminPassword == '') {
            $adminPassword = $dataLama['password'];
        } else {
            $adminPassword = password_hash($adminPassword, PASSWORD_DEFAULT);
        }

        if ($dataLama['username'] == $this->request->getVar('username')) {
            $ruleUsername = 'required|alpha_numeric';
        } else {
            $ruleUsername = 'required|is_unique[admin.username]|alpha_numeric';
        }

        if ($dataLama['email'] == $this->request->getVar('email')) {
            $ruleEmail = 'required|valid_email';
        } else {
            $ruleEmail = 'required|is_unique[admin.email]|valid_email';
        }

        if ($dataLama['no_telephone'] == $this->request->getVar('no_telp')) {
            $ruleTelephone = 'required';
        } else {
            $ruleTelephone = 'required|is_unique[admin.no_telephone]';
        }

        if (!$this->validate([
            'username' => [
                'rules' => $ruleUsername,
                'errors' => [
                    'required' => 'Username tidak boleh kosong',
                    'is_unique' => 'Username sudah terdaftar',
                    'alpha_numeric' => 'Username tidak boleh berisi spasi'
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
            ]
        ])) {
            return redirect()->to('http://localhost:8080/admin/edit/' . $this->request->getVar('id'))->withInput();
        }

        $this->adminModel->save([
            'id_admin' => $this->request->getVar('id'),
            'username' => $this->request->getVar('username'),
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'password' => $adminPassword,
            'email' => $this->request->getVar('email'),
            'alamat' => $this->request->getVar('alamat'),
            'no_telephone' => $this->request->getVar('no_telp')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('http://localhost:8080/admin');
    }

    public function delete()
    {
        $id = $this->request->getVar('id_delete');
        $this->adminModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('http://localhost:8080/admin');
    }
}
