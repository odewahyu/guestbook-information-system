<?php

namespace App\Controllers;

use App\Models\TamuModel;

require '/Applications/MAMP/htdocs/bukutamuapp/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

class Tamu extends BaseController
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
        $keywordData = $this->request->getVar();
        $keyword = '';

        if (isset($keywordData) && isset($keywordData['keyword'])) {
            $keyword = $keywordData['keyword'];
            session()->set('caritamu', $keyword);
        } else {
            $keyword = session()->get('caritamu');
        }

        if ($keyword == '') {
            $tamu = $this->tamuModel->getTamu();
        } else {
            $tamu = $this->tamuModel->search($keyword)->paginate(10, 'tamu');
        }

        $currentPage = $this->request->getVar('page_tamu') ? $this->request->getVar('page_tamu') : 1;

        $data = [
            'title' => 'Data Tamu',
            'activeMenu' => 'tamu',
            'tamu' => $tamu,
            'pager' => $this->tamuModel->pager,
            'currentPage' => $currentPage,
        ];

        return view('tamu/index', $data);
    }

    public function cetakLaporan()
    {
        $awal = $this->request->getVar('tanggal_awal');
        $akhir = $this->request->getVar('tanggal_akhir');

        $tgl_laporan = "$awal - $akhir";

        $laporan = $this->tamuModel
            ->where('tanggal_kunjungan >=', $awal)
            ->where('tanggal_kunjungan <=', $akhir)
            ->where('status', 'Selesai')
            ->get()
            ->getResultArray();

        if ($awal == $akhir) {
            $laporan = $this->tamuModel
                ->where(['tanggal_kunjungan' => $awal])
                ->where('status', 'Selesai')
                ->get()
                ->getResultArray();
            $tgl_laporan = $awal;
        }

        if ($awal > $akhir) {
            session()->setFlashdata('pesanerror', 'Tanggal yang dimasukan tidak sesuai');
            return redirect()->to('http://localhost:8080/tamu');
        }

        $data = [
            'title' => 'Laporan',
            'tgl_laporan' => $tgl_laporan,
            'laporan' => $laporan
        ];

        $html = view('/tamu/laporan', $data);

        $html2pdf = new Html2Pdf('P', 'A4', 'en', true, 'UTF-8', array(5, 5, 5, 5), false);
        $html2pdf->writeHTML($html);
        $this->response->setContentType('application/pdf');
        $html2pdf->output('laporan_buku_tamu_' . $tgl_laporan . '.pdf');
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Tamu',
            'activeMenu' => 'tamu',
            'validation' => \Config\Services::validation()
        ];

        return view('tamu/create', $data);
    }

    public function save()
    {
        $keperluan = $this->request->getVar('keperluan');
        $email = $this->request->getVar('email');
        $instansi = $this->request->getVar('instansi');

        if ($keperluan == 'Bertemu Camat') {
            $idPegawai = 1;
        } else if ($keperluan == 'Bertemu Ketua Sekretariat') {
            $idPegawai = 3;
        } else {
            $idPegawai = 0;
        }

        if ($email == '') {
            $email = '-';
        }

        if ($instansi == '') {
            $instansi = '-';
        }

        if (!$this->validate([
            'nama_lengkap' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong',
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat tidak boleh kosong',
                ]
            ],
            'no_telp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'No. telephone tidak boleh kosong',

                ]
            ],
            'tgl_kunjungan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal kunjungan tidak boleh kosong',

                ]
            ],
            'jam_kunjungan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jam kunjungan tidak boleh kosong',

                ]
            ]
        ])) {
            return redirect()->to('http://localhost:8080/tamu/create')->withInput();
        }

        $this->tamuModel->save([
            'id_pegawai' => $idPegawai,
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'email' => $email,
            'no_telephone' => $this->request->getVar('no_telp'),
            'alamat' => $this->request->getVar('alamat'),
            'instansi' => $instansi,
            'keperluan' => $keperluan,
            'tanggal_kunjungan' => $this->request->getVar('tgl_kunjungan'),
            'jam_kunjungan' => $this->request->getVar('jam_kunjungan'),
            'ruang_kunjungan' => $this->request->getVar('ruangan'),
            'status' => 'Diterima',
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('http://localhost:8080/tamu');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Data Tamu',
            'activeMenu' => 'tamu',
            'tamu' => $this->tamuModel->find($id),
            'validation' => \Config\Services::validation()
        ];

        return view('tamu/edit', $data);
    }

    public function update()
    {
        $keperluan = $this->request->getVar('keperluan');
        $idTamu = $this->request->getVar('id');
        $email = $this->request->getVar('email');
        $instansi = $this->request->getVar('instansi');
        $status = $this->request->getVar('status');

        $dataLama = $this->tamuModel->find($this->request->getVar('id'));

        if ($keperluan == 'Bertemu Camat') {
            $idPegawai = 1;
        } else if ($keperluan == 'Bertemu Ketua Sekretariat') {
            $idPegawai = 3;
        } else {
            $idPegawai = 0;
        }

        if ($email == '') {
            $email = '-';
        }

        if ($instansi == '') {
            $instansi = '-';
        }

        if (!$this->validate([
            'nama_lengkap' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama tidak boleh kosong',
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat tidak boleh kosong',
                ]
            ],
            'no_telp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'No. telephone tidak boleh kosong',

                ]
            ],
            'instansi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Instansi tidak boleh kosong',

                ]
            ],
            'jam_kunjungan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jam kunjungan tidak boleh kosong',

                ]
            ]
        ])) {
            return redirect()->to('http://localhost:8080/tamu/edit/' . $this->request->getVar('id'))->withInput();
        }

        $tamu = $this->tamuModel
            ->select('nama_lengkap as nama, email, DATE_FORMAT(tanggal_kunjungan, "%d %M %Y")
            as tgl, TIME_FORMAT(jam_kunjungan, "%H:%i") as jam, ruang_kunjungan as ruangan')
            ->where('id_tamu', $idTamu)
            ->get()->getResultArray()[0];

        if ($status == 'Diterima') {
            $message = "<h2>Konfirmasi Kunjungan Tamu</h2>Kepada Bapak/Ibu 
        atas nama " . $tamu['nama'] . ", permintaan kunjungan anda telah diterima. 
        Silahkan hadir pada pukul " . $tamu['jam'] . " tanggal " . $tamu['tgl'] . " 
        di ruangan " . $tamu['ruangan'] . " Kantor Camat Mengwi";
        }

        if ($status == 'Ditolak') {
            $message = "<h2>Konfirmasi Kunjungan Tamu</h2>Kepada Bapak/Ibu 
        atas nama " . $tamu['nama'] .
                ", mohon maaf permintaan kunjungan anda pada pukul " . $tamu['jam'] .
                " tanggal " . $tamu['tgl'] . " telah ditolak";
        }

        if ($status != 'Selesai' ) {
            $this->sendEmail($tamu['email'], 'Konfirmasi Kunjungan Tamu', $message);
        }

        $this->tamuModel->save([
            'id_tamu' => $idTamu,
            'id_pegawai' => $idPegawai,
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'email' => $email,
            'no_telephone' => $this->request->getVar('no_telp'),
            'alamat' => $this->request->getVar('alamat'),
            'instansi' => $instansi,
            'keperluan' => $keperluan,
            'tanggal_kunjungan' => $this->request->getVar('tgl_kunjungan'),
            'jam_kunjungan' => $this->request->getVar('jam_kunjungan'),
            'ruang_kunjungan' => $this->request->getVar('ruangan'),
            'status' => $status,
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('http://localhost:8080/tamu');
    }

    public function delete()
    {
        $id = $this->request->getVar('id_delete');
        $this->tamuModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('http://localhost:8080/tamu');
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
