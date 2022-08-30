<?php

namespace App\Models;

use CodeIgniter\Model;

class PenilaianModel extends Model
{
    protected $table      = 'penilaian';
    protected $primaryKey = 'id_penilaian';
    protected $useTimestamps = false;
    protected $allowedFields = ['kategori_penilaian'];

    public function hasilPenilaian()
    {
        return $this->select('COUNT(id_penilaian) as jml, kategori_penilaian as pnl')
            ->groupBy('kategori_penilaian')
            ->get()
            ->getResult();
    }
}
