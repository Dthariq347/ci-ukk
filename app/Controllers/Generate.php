<?php

namespace App\Controllers;



use Dompdf\Dompdf as Dompdf;

class generate extends BaseController
{
    protected $db, $builder;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }
    public function index()
    {
        $data = [
            'title' => 'generate laporan (admin) | MTSN 3 Jakarta Selatan',
            'validation' => \Config\Services::validation(),
            'bulan' => $this->BulanModel->getBulan(),
            'read' => $this->PembayaranModel
                ->select('nis ,nama, nama_kelas, bln_bayar, thn_bayar, nominal, jumlah_bayar')
                ->join('users', 'users.id = pembayaran.id AND users.id = pembayaran.siswa', 'left')
                ->join('siswa', 'siswa.nisn = pembayaran.nisn')
                ->join('spp', 'spp.id_spp = pembayaran.id_spp')
                ->join('kelas', 'kelas.id_kelas = siswa.id_kelas')
                ->paginate(3, 'pembayaran'),
            'pager' => $this->PembayaranModel->pager,
        ];
        return view('/generate/index', $data);
    }
    public function printpdf()
    {
        $dompdf = new Dompdf();


        $bln_bayar = $this->request->getVar('bln_bayar');
        $thn_bayar = $this->request->getVar('thn_bayar');
        // walaupun tidak di input tetap print ALL
        if ($bln_bayar == NULL && $thn_bayar == NULL) {

            $data = [
                'title' => 'generate laporan (admin) | MTSN 3 Jakarta Selatan',
                'read' => $this->PembayaranModel
                    ->select('nis ,nama, nama_kelas, bln_bayar, thn_bayar, nominal, jumlah_bayar')
                    ->join('users', 'users.id = pembayaran.id AND users.id = pembayaran.siswa', 'left')
                    ->join('siswa', 'siswa.nisn = pembayaran.nisn')
                    ->join('spp', 'spp.id_spp = pembayaran.id_spp')
                    ->join('kelas', 'kelas.id_kelas = siswa.id_kelas')
                    ->orderBy('bln_bayar', 'ASC')
                    ->orderBy('thn_bayar', 'ASC')
                    ->paginate(50, 'pembayaran'),

                'pager' => $this->PembayaranModel->pager,

            ];


            $html = view('/generate/read', $data);
            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            // (Optional) Setup the paper size and orientation
            $dompdf->setPaper('A4', 'landscape');

            // Render the HTML as PDF
            $dompdf->render();

            // Output the generated PDF to Browser

            $dompdf->stream('invoice.pdf', array(
                "Attachment" => false

            ));
        }
        if ($bln_bayar) {
            $data = [
                'title' => 'generate laporan (admin) | MTSN 3 Jakarta Selatan',
                'read' => $this->PembayaranModel
                    ->select('nis ,nama, nama_kelas, bln_bayar, thn_bayar, nominal, jumlah_bayar')
                    ->join('users', 'users.id = pembayaran.id AND users.id = pembayaran.siswa', 'left')
                    ->join('siswa', 'siswa.nisn = pembayaran.nisn')
                    ->join('spp', 'spp.id_spp = pembayaran.id_spp')
                    ->join('kelas', 'kelas.id_kelas = siswa.id_kelas')
                    ->where('bln_bayar =', $bln_bayar)
                    ->paginate(50, 'pembayaran'),

                'pager' => $this->PembayaranModel->pager,

            ];


            $html = view('/generate/read', $data);
            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            // (Optional) Setup the paper size and orientation
            $dompdf->setPaper('A4', 'landscape');

            // Render the HTML as PDF
            $dompdf->render();

            // Output the generated PDF to Browser

            $dompdf->stream('invoice.pdf', array(
                "Attachment" => false

            ));
        }
        if ($thn_bayar) {
            $data = [
                'title' => 'generate laporan (admin) | MTSN 3 Jakarta Selatan',
                'read' => $this->PembayaranModel
                    ->select('nis ,nama, nama_kelas, bln_bayar, thn_bayar, nominal, jumlah_bayar')
                    ->join('users', 'users.id = pembayaran.id AND users.id = pembayaran.siswa', 'left')
                    ->join('siswa', 'siswa.nisn = pembayaran.nisn')
                    ->join('spp', 'spp.id_spp = pembayaran.id_spp')
                    ->join('kelas', 'kelas.id_kelas = siswa.id_kelas')
                    ->where('thn_bayar =', $thn_bayar)
                    ->paginate(50, 'pembayaran'),

                'pager' => $this->PembayaranModel->pager,

            ];


            $html = view('/generate/read', $data);
            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            // (Optional) Setup the paper size and orientation
            $dompdf->setPaper('A4', 'landscape');

            // Render the HTML as PDF
            $dompdf->render();

            // Output the generated PDF to Browser

            $dompdf->stream('invoice.pdf', array(
                "Attachment" => false

            ));
        } else {
            $data = [
                'title' => 'generate laporan (admin) | MTSN 3 Jakarta Selatan',
                'read' => $this->PembayaranModel
                    ->select('nis ,nama, nama_kelas, bln_bayar, thn_bayar, nominal, jumlah_bayar')
                    ->join('users', 'users.id = pembayaran.id AND users.id = pembayaran.siswa', 'left')
                    ->join('siswa', 'siswa.nisn = pembayaran.nisn')
                    ->join('spp', 'spp.id_spp = pembayaran.id_spp')
                    ->join('kelas', 'kelas.id_kelas = siswa.id_kelas')
                    ->where('bln_bayar =', $bln_bayar)
                    ->where('thn_bayar =', $thn_bayar)
                    ->paginate(50, 'pembayaran'),

                'pager' => $this->PembayaranModel->pager,

            ];


            $html = view('/generate/read', $data);
            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            // (Optional) Setup the paper size and orientation
            $dompdf->setPaper('A4', 'landscape');

            // Render the HTML as PDF
            $dompdf->render();

            // Output the generated PDF to Browser

            $dompdf->stream('invoice.pdf', array(
                "Attachment" => false

            ));
        }


        // untuk jalanin bulan bayar nya saja

        // untuk jalanin tahun bayar nya saja

        // untuk jalanin dua dua nya


    }
}
