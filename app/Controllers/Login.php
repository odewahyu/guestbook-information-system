<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\PegawaiModel;

class Login extends BaseController
{
    protected $adminModel;
    protected $pegawaiModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->pegawaiModel = new PegawaiModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Login',
        ];

        return view('/login/index', $data);
    }

    public function loginValidation()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $jenisUser = $this->request->getVar('jenis_user');

        $admin = $this->adminModel->getLogin($username);
        $pegawai = $this->pegawaiModel->getLogin($username);

        if ($jenisUser == 'admin') {
            if ($admin) {
                if (password_verify($password, $admin['password'])) {
                    session()->set([
                        'id_admin' => $admin['id_admin'],
                        'username_admin' => $admin['username'],
                        'nama_admin' => $admin['nama_lengkap'],
                        'email_admin' => $admin['email'],
                        'alamat_admin' => $admin['alamat'],
                        'no_telp_admin' => $admin['no_telephone'],
                        'logged_in_admin' => true,
                    ]);
                    return redirect()->to('http://localhost:8080/home-admin');
                } else {
                    session()->setFlashdata('pesan', 'Username/Password anda salah');
                    return redirect()->to('http://localhost:8080/login');
                }
            } else {
                session()->setFlashdata('pesan', 'Username/Password anda salah');
                return redirect()->to('http://localhost:8080/login');
            }
        }

        if ($jenisUser == 'pegawai') {
            if ($pegawai) {
                if (password_verify($password, $pegawai['password'])) {
                    session()->set([
                        'id_pegawai' => $pegawai['id_pegawai'],
                        'username_pegawai' => $pegawai['username'],
                        'nama_pegawai' => $pegawai['nama_lengkap'],
                        'email_pegawai' => $pegawai['email'],
                        'alamat_pegawai' => $pegawai['alamat'],
                        'no_telp_pegawai' => $pegawai['no_telephone'],
                        'logged_in_pegawai' => true,
                    ]);
                    return redirect()->to('http://localhost:8080/home-pegawai');
                } else {
                    session()->setFlashdata('pesan', 'Username/Password anda salah');
                    return redirect()->to('http://localhost:8080/login');
                }
            } else {
                session()->setFlashdata('pesan', 'Username/Password anda salah');
                return redirect()->to('http://localhost:8080/login');
            }
        }
    }

    function logout()
    {
        session()->destroy();
        return redirect()->to('http://localhost:8080/login');
    }
}
