<?php

namespace App\Models;

use CodeIgniter\Model;

class PegawaiModel extends Model
{
    protected $table      = 'pegawai';
    protected $primaryKey = 'id_pegawai';
    protected $useTimestamps = false;
    protected $allowedFields = ['id_jabatan', 'username', 'nama_lengkap', 'password', 'email', 'alamat', 'no_telephone'];

    public function getPaginate($nb)
    {
        return $this->select('*')
            ->join('jabatan', 'pegawai.id_jabatan = jabatan.id_jabatan', 'inner')
            ->paginate($nb, 'pegawai');
    }

    public function getLogin($username)
    {
        return $this->where(['username' => $username])->first();
    }

    public function getSearchPaginate($nb, $keyword)
    {
        return $this->select('*')
            ->join('jabatan', 'pegawai.id_jabatan = jabatan.id_jabatan', 'inner')
            ->like('nama_lengkap', $keyword)
            ->paginate($nb, 'pegawai');
    }
}
