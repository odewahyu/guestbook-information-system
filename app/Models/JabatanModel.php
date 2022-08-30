<?php

namespace App\Models;

use CodeIgniter\Model;

class JabatanModel extends Model
{
    protected $table      = 'jabatan';
    protected $primaryKey = 'id_jabatan';
    protected $useTimestamps = false;
    protected $allowedFields = ['nama_jabatan'];

    public function getJabatan()
    {
        return $this->findAll();
    }

    public function search($keyword)
    {
        return $this->like('nama_jabatan', $keyword);
    }
}
