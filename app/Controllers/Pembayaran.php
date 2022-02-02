<?php

namespace App\Controllers;

use CodeIgniter\Database\BaseBuilder;

class Pembayaran extends BaseController
{
    protected $db, $builder;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {

        $data = [
            'title' => 'create (siswa) | MTSN 3 Jakarta Selatan',
            'validation' => \Config\Services::validation(),
            'home' => $this->PembayaranModel->getPembayaran(),
            'spp' => $this->SppModel->getspp(),
            'nisn' => $this->SiswaModel->getSiswa(),
            'bulan' => $this->BulanModel->getBulan(),
            'status' => $this->StatusModel->getstatus(),
        ];
        $this->builder = $this->db->table('users');
        $this->builder->select('users.id as id_user ,username');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('auth_groups.id !=', 3);
        $query = $this->builder->get();

        $data['users'] = $query->getResultArray();

        $this->builder = $this->db->table('users');
        $this->builder->select('users.id as id_user , username, fullname');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('auth_groups.id', 3);
        $query2 = $this->builder->get();

        $data['name'] = $query2->getResultArray();
        return view('/transaksi/index', $data);
    }
    public function readpembayaran()
    {

        if (in_groups('admin')) {
            $keyword = $this->request->getVar('keyword');
            if ($keyword) {
                $pembayaran = $this->PembayaranModel->search($keyword);
            } else {
                $pembayaran = $this->PembayaranModel;
            }
            $data = [
                'title' => 'Read | Web Dzabitha',
                'read' => $pembayaran
                    ->select('id_pembayaran ,pembayaran.id as username,  nama, tgl_bayar, bln_bayar, thn_bayar, nominal, jumlah_bayar, status_pembayaran')
                    ->join('users', 'users.id = pembayaran.id AND users.id = pembayaran.siswa', 'left')
                    ->join('siswa', 'siswa.nisn = pembayaran.nisn')
                    ->join('spp', 'spp.id_spp = pembayaran.id_spp')
                    ->join('status', 'status.id_status = pembayaran.id_status')
                    ->orderBy('id_pembayaran', 'ASC')
                    ->paginate(3, 'pembayaran'),
                'pager' => $this->PembayaranModel->pager,
            ];
            return view('histori/read', $data);
        }
        if (in_groups('petugas')) {
            $keyword = $this->request->getVar('keyword');
            if ($keyword) {
                $pembayaran = $this->PembayaranModel->search($keyword);
            } else {
                $pembayaran = $this->PembayaranModel;
            }
            $data = [
                'title' => 'Read | Web Dzabitha',
                'read' => $pembayaran
                    ->select('id_pembayaran ,pembayaran.id as username,  nama, tgl_bayar, bln_bayar, thn_bayar, nominal, jumlah_bayar, status_pembayaran')
                    ->join('users', 'users.id = pembayaran.id AND users.id = pembayaran.siswa', 'left')
                    ->join('siswa', 'siswa.nisn = pembayaran.nisn')
                    ->join('spp', 'spp.id_spp = pembayaran.id_spp')
                    ->join('status', 'status.id_status = pembayaran.id_status')
                    ->orderBy('id_pembayaran', 'ASC')
                    ->paginate(3, 'pembayaran'),
                'pager' => $this->PembayaranModel->pager,
            ];
            return view('histori/read', $data);
        } else {

            if (in_groups('siswa')) {
                $data = [
                    'title' => 'Read | Web Dzabitha',
                    'read' => $this->PembayaranModel
                        ->select('id_pembayaran ,pembayaran.id as username,  nama, tgl_bayar, bln_bayar, thn_bayar, nominal, jumlah_bayar')
                        ->join('users', 'users.id = pembayaran.id AND users.id = pembayaran.siswa', 'left')
                        ->join('siswa', 'siswa.nisn = pembayaran.nisn')
                        ->join('spp', 'spp.id_spp = pembayaran.id_spp')
                        ->where('pembayaran.siswa', user()->id)
                        ->orderBy('id_pembayaran', 'ASC')
                        ->paginate(3, 'pembayaran'),
                    'pager' => $this->PembayaranModel->pager,
                ];
                return view('histori/read', $data);
            }
        }
    }
    public function savepembayaran()
    {

        $jumlah = $this->request->getVar('jumlah_bayar');
        $jumbar = str_replace('.', '', $jumlah);

        // validasi input 
        if (!$this->validate([
            'nisn' => [
                'rules' => 'required|integer',
                'errors' => [
                    'required' => '{field}  wajib di isi!!',
                    'integer' => '{field}  harus berupa angka!!',
                ]
            ],
            'bln_bayar' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field}  wajib di isi!!',
                ]
            ],
            'thn_bayar' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field}  wajib di isi!!',
                ]
            ],
            'jumlah_bayar' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field}  wajib di isi!!',
                ]
            ],

        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to('/home/contact/')->withInput()->with('validation', $validation);
            return redirect()->to('/pembayaran/index/')->withInput();
        }

        $this->PembayaranModel->save([
            'id' => $this->request->getVar('id'),
            'siswa' => $this->request->getVar('siswa'),
            'nisn' => $this->request->getVar('nisn'),
            'tgl_bayar' => $this->request->getVar('tgl_bayar'),
            'bln_bayar' => $this->request->getVar('bln_bayar'),
            'thn_bayar' => $this->request->getVar('thn_bayar'),
            'id_spp' => $this->request->getVar('id_spp'),
            'jumlah_bayar' => $jumbar,
            'id_status' => $this->request->getVar('id_status')

        ]);

        session()->setFlashdata('pesan', 'data  berhasil di tambahkan');

        return redirect()->to('/pembayaran/readpembayaran/');
    }
}
