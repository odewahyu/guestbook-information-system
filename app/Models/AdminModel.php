<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table      = 'admin';
    protected $primaryKey = 'id_admin';
    protected $useTimestamps = false;
    protected $allowedFields = ['username', 'nama_lengkap', 'password', 'email', 'alamat', 'no_telephone'];

    public function getAdmin()
    {
        return $this->findAll();
    }

    public function getLogin($username)
    {
        return $this->where('username', $username)->first();
    }

    public function search($keyword)
    {
        return $this->like('nama_lengkap', $keyword);
    }
}
