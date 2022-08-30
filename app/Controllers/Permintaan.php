<?php

namespace App\Controllers;

use App\Models\TamuModel;

class Permintaan extends BaseController
{

    protected $tamuModel;
    protected $email;

    public function __construct()
    {
        $this->tamuModel = new TamuModel();
        $this->email = \Config\Services::email();
    }


    public function index()
    {
        $date = $this->request->getVar('tanggal');
        $all = $this->request->getVar('showall');
        $search = $this->request->getVar('search');
        $idPegawai = session()->get('id_pegawai');

        $permintaanTamu = $this->tamuModel
            ->where('tamu.id_pegawai', $idPegawai)
            ->where('tamu.status', '-');

        if (isset($search)) {
            $permintaanTamu = $this->tamuModel
                ->where([
                    'id_pegawai' => $idPegawai,
                    'status' => '-',
                    'tanggal_kunjungan' => $date
                ]);
        }

        if (isset($all)) {
            $permintaanTamu = $this->tamuModel
                ->where('tamu.id_pegawai', $idPegawai)
                ->where('tamu.status', '-');
        }

        $currentPage = $this->request->getVar('page_permintaan') ? $this->request->getVar('page_permintaan') : 1;

        $data = [
            'title' => 'Permintaan',
            'activeMenu' => 'permintaan',
            'permintaanTamu' => $permintaanTamu->paginate(10, 'permintaan'),
            'pager' => $this->tamuModel->pager,
            'currentPage' => $currentPage
        ];

        return view('/permintaan/index', $data);
    }

    public function terima()
    {
        $id = $this->request->getVar('id_terima');

        $tamu = $this->tamuModel
            ->select('nama_lengkap as nama, email, DATE_FORMAT(tanggal_kunjungan, "%d %M %Y") 
            as tgl, TIME_FORMAT(jam_kunjungan, "%H:%i") as jam, ruang_kunjungan as ruangan')
            ->where('id_tamu', $id)
            ->get()->getResultArray()[0];

        $this->tamuModel->save([
            'id_tamu' => $id,
            'status' => 'Diterima'
        ]);

        $message = "<h2>Konfirmasi Kunjungan Tamu</h2>Kepada Bapak/Ibu 
        atas nama " . $tamu['nama'] . ", permintaan kunjungan anda telah diterima. 
        Silahkan hadir pada pukul " . $tamu['jam'] . " tanggal " . $tamu['tgl'] . " 
        di ruangan " . $tamu['ruangan'] . " Kantor Camat Mengwi";

        $this->sendEmail($tamu['email'], 'Konfirmasi Kunjungan Tamu', $message);

        session()->setFlashdata('pesan', 'Anda telah menerima kunjungan tamu, email telah dikirimkan kepada tamu');
        return redirect()->to('http://localhost:8080/permintaan');
    }

    public function tolak()
    {
        $id = $this->request->getVar('id_tolak');

        $tamu = $this->tamuModel
            ->select('nama_lengkap as nama, email, DATE_FORMAT(tanggal_kunjungan, "%d %M %Y") 
            as tgl, TIME_FORMAT(jam_kunjungan, "%H:%i") as jam, ruang_kunjungan as ruangan')
            ->where('id_tamu', $id)
            ->get()->getResultArray()[0];

        $this->tamuModel->save([
            'id_tamu' => $id,
            'status' => 'Ditolak'
        ]);

        $message = "<h2>Konfirmasi Kunjungan Tamu</h2>Kepada Bapak/Ibu 
        atas nama " . $tamu['nama'] . ", mohon maaf permintaan kunjungan anda pada pukul " . $tamu['jam']
            . " tanggal " . $tamu['tgl'] . " telah ditolak";

        $this->sendEmail($tamu['email'], 'Konfirmasi Kunjungan Tamu', $message);

        session()->setFlashdata('pesan', 'Anda telah menolak kunjungan tamu');
        return redirect()->to('http://localhost:8080/permintaan');
    }

    private function sendEmail($to, $title, $message)
    {
        $this->email->setFrom('bukutamumengwi@gmail.com', 'Buku Tamu Mengwi');
        $this->email->setTo($to);
        $this->email->setSubject($title);
        $this->email->setMessage($message);

        if (!$this->email->send()) {
            return false;
        } else {
            return true;
        }
    }
}
