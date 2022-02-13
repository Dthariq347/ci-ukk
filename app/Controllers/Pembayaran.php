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

    public function search()
    {

        $data = [
            'title' => 'create (siswa) | MTSN 3 Jakarta Selatan',
            'validation' => \Config\Services::validation(),
            'nisn' => $this->SiswaModel->getSiswa()
        ];
        return view('/transaksi/search', $data);
    }


    public function index()
    {
        $search = $this->request->getVar('nisn');
        $carisiswa = $this->SiswaModel->find($search);

        $nilai = $this->NilaiModel->where('nisn', $search)->find();

        $tahun = date('Y');
        $date = $this->SppModel->where('tahun', $tahun)->find();


        $id_spp = $date[0]['id_spp'];
        $nominal = $date[0]['nominal'];

        // $nilai_lebih = $nilai[0]['nominal_lebih'];
        // $nilai_kurang = $nilai[0]['nominal_kurang'];






        if ($nilai == NULL) {
            $data = [
                'title' => 'create (siswa) | MTSN 3 Jakarta Selatan',
                'validation' => \Config\Services::validation(),
                'home' => $this->PembayaranModel->getPembayaran(),
                'id_spp' => $id_spp,
                'nominal' => $nominal,
                'nisn' => $carisiswa,
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
            return view('/transaksi/index2', $data);
        } else {
            if ($nilai[0]['nisn'] != NULL) {
                $nilai_lebih = $nilai[0]['nominal_lebih'];
                $nilai_kurang = $nilai[0]['nominal_kurang'];
                if ($nominal - $nilai_lebih) {
                    $nominal_bayar = $nominal - $nilai_lebih;
                } else {
                    if ($nominal + $nilai_kurang) {
                        $nominal_bayar = $nominal + $nilai_kurang;
                    }
                }

                $data = [
                    'title' => 'create (siswa) | MTSN 3 Jakarta Selatan',
                    'validation' => \Config\Services::validation(),
                    'home' => $this->PembayaranModel->getPembayaran(),
                    'spp' => $this->SppModel->getspp(),
                    'nisn' => $this->SiswaModel->getSiswa(),
                    'id_spp' => $id_spp,
                    'nominal' => $nominal,
                    'nisn' => $carisiswa,
                    'bulan' => $this->BulanModel->getBulan(),
                    'status' => $this->StatusModel->getstatus(),
                    'nilai_lebih' => $nilai_lebih,
                    'nilai_kurang' => $nilai_kurang,
                    'nominal_bayar' => $nominal_bayar,
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
        }
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
        $id_nilai = $this->NilaiModel->where('nisn', $this->request->getVar('nisn'))->find();


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

        $sppmodel = $this->SppModel->find($this->request->getVar('id_spp'));
        $apa = $sppmodel['nominal'];
        $lebih_jumbar = NULL;
        $kurang_jumbar = NULL;

        if ($jumbar >= $apa) {
            $lebih_jumbar = $jumbar - $apa;
        }
        if ($jumbar <= $apa) {
            $kurang_jumbar = $apa - $jumbar;
        }



        $nilai = [
            'nisn' => $this->request->getVar('nisn'),
            'nominal_lebih' => $lebih_jumbar,
            'nominal_kurang' => $kurang_jumbar

        ];
        $this->NilaiModel->insert($nilai);
        // $spp = $this->PembayaranModel->save(['id_spp' => $this->request->getVar('id_spp')]);

        // if ($spp >= $jumlah_bayarr) {
        // }



        session()->setFlashdata('pesan', 'data  berhasil di tambahkan');

        return redirect()->to('/pembayaran/readpembayaran/');
    }
    public function editpembayaran($pembayaran)
    {


        $data = [
            'title' => 'create (siswa) | MTSN 3 Jakarta Selatan',
            'validation' => \Config\Services::validation(),
            'home' => $this->PembayaranModel->getPembayaran($pembayaran),
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
        return view('/transaksi/edit', $data);
    }
    public function updatepembayaran($pembayaran)
    {
        // validation
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
            // return redirect()->to('/home/edit/' . $this->request->getVar('id'))->withInput()->with('validation', $validation);
            return redirect()->to('/pembayaran/editpembayaran/' . $this->request->getVar('id_pembayaran'))->withInput();
        }

        // input/output
        $this->PembayaranModel->save([
            'id_pembayaran' => $pembayaran,
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
        // Flashdata 

        session()->setFlashdata('pesan', 'data pembayaran berhasil di ubah');

        return redirect()->to('/pembayaran/readpembayaran/');
    }
}
