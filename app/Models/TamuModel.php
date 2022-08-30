<?php

namespace App\Models;

use CodeIgniter\Model;
use PDO;

class TamuModel extends Model
{
    protected $table      = 'tamu';
    protected $primaryKey = 'id_tamu';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'id_pegawai',
        'nama_lengkap',
        'email',
        'no_telephone',
        'alamat',
        'instansi',
        'keperluan',
        'tanggal_kunjungan',
        'jam_kunjungan',
        'ruang_kunjungan',
        'status',
    ];

    public function getKeperluan()
    {
        return $this->select('COUNT(tamu.id_tamu) as jml, tamu.keperluan as kpr')
            ->where('status', 'Selesai')
            ->groupBy('tamu.keperluan')
            ->get()
            ->getResult();
    }

    public function getTamuBulanan($tahun)
    {
        return $this->select("COUNT(id_tamu) as jml, DATE_FORMAT(tanggal_kunjungan, '%M') as bulan")
            ->where('YEAR(tanggal_kunjungan)', $tahun)
            ->where('status', 'Selesai')
            ->groupBy("DATE_FORMAT(tanggal_kunjungan, '%M')")
            ->orderBy("FIELD(bulan,'January','February','March','April', 'May')")
            ->get()
            ->getResult();
    }

    public function getJumlahTamu()
    {
        return $this->select("COUNT(id_tamu) as jml")
            ->where('status', 'Selesai')
            ->get()->getResultArray();
    }

    public function getTamuPerHari($tanggal)
    {
        return $this->select("COUNT(id_tamu) as jml")
            ->where('tanggal_kunjungan', $tanggal)
            ->where('status', 'Selesai')
            ->get()
            ->getResultArray();
    }

    public function getTamu()
    {
        return $this->orderBy('tanggal_kunjungan', 'DESC')->paginate(10, 'tamu');
    }

    public function search($keyword)
    {
        return $this->like('nama_lengkap', $keyword)
            ->orLike('status', $keyword);
    }
}
