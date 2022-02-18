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
        // mencari data yang search awal
        $search = $this->request->getVar('nisn');
        // mencari data yang search pada model siswa
        $carisiswa = $this->SiswaModel->find($search);

        // mencari data apakah pada yang disearch ada nilai lebih or kurang 
        $nilai = $this->NilaiModel->where('nisn', $search)->find();

        // mencari data di model SPP 
        $tahun = date('Y');
        $date = $this->SppModel->where('tahun', $tahun)->find();

        // untuk tampilan dan value SPP 
        $id_spp = $date[0]['id_spp'];
        $nominal = $date[0]['nominal'];
        $tahun = $date[0]['tahun'];

        // ketika nisn yang di cari pada model nilai == null munculin bawahnya
        if ($nilai == NULL) {
            $data = [
                'title' => 'create (siswa) | MTSN 3 Jakarta Selatan',
                'validation' => \Config\Services::validation(),
                'home' => $this->PembayaranModel->getPembayaran(),
                'id_spp' => $id_spp,
                'nominal' => $nominal,
                'tahun' => $tahun,
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
            // ketika nisn yang di cari pada model nilai != null munculin bawahnya
            if ($nilai[0]['nisn'] != NULL) {

                $nilai_lebih = $nilai[0]['nominal_lebih'];
                $nilai_kurang = $nilai[0]['nominal_kurang'];

                // $sama = $nilai_lebih == $nilai_kurang
                $bayar_nominal_lebih = $nominal - $nilai_lebih;
                $bayar_nominal_kurang = $nominal + $nilai_kurang;


                if ($bayar_nominal_lebih && $nilai_kurang == NULL) {
                    $nominal_bayar = $nominal - $nilai_lebih;
                } elseif ($bayar_nominal_kurang && $nilai_lebih == NULL) {
                    $nominal_bayar = $nominal + $nilai_kurang;
                } else {
                    $nominal_bayar = $nominal;
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
                    ->where('pembayaran.id', user()->id)
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

        $search = $this->request->getVar('nisn');

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
            return redirect()->to('/pembayaran/index?nisn=' . $search)->withInput();
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

        $search = $this->request->getVar('nisn');
        $nilai = $this->NilaiModel->where('nisn', $search)->find();

        if ($nilai == NULL) {
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
        } else {
            // ketika nisn yang di cari pada model nilai != null munculin bawahnya
            if ($nilai[0]['nisn'] != NULL) {
                $id_nilai = $this->NilaiModel->where('nisn', $this->request->getVar('nisn'))->find();


                $tahun = date('Y');
                $date = $this->SppModel->where('tahun', $tahun)->find();

                $nominal = $date[0]['nominal'];
                $tahun = $date[0]['tahun'];

                $nilai_lebih = $nilai[0]['nominal_lebih'];
                $nilai_kurang = $nilai[0]['nominal_kurang'];

                $bayar_nominal_lebih = $nominal - $nilai_lebih;
                $bayar_nominal_kurang = $nominal + $nilai_kurang;

                if ($bayar_nominal_lebih && $nilai_kurang == NULL) {
                    $nominal_bayar = $nominal - $nilai_lebih;
                } elseif ($bayar_nominal_kurang && $nilai_lebih == NULL) {
                    $nominal_bayar = $nominal + $nilai_kurang;
                } else {
                    $nominal_bayar = NULL;
                }

                $jumlah_lebih = NULL;
                $jumlah_kurang = NULL;

                if ($jumbar > $nominal_bayar) {
                    $jumlah_lebih = $jumbar - $nominal_bayar;
                }
                if ($jumbar < $nominal_bayar) {
                    $jumlah_kurang = $nominal_bayar - $jumbar;
                }

                if ($jumlah_lebih && $jumlah_kurang) {
                    if ($jumbar >= $nominal_bayar) {
                        $jumlah_lebih = $jumbar - $nominal_bayar;
                    }
                } else {
                    if ($jumbar <= $nominal_bayar) {
                        $jumlah_kurang = $nominal_bayar - $jumbar;
                    }
                }

                $this->NilaiModel->save([
                    'id_nilai' => $id_nilai[0]['id_nilai'],
                    'nominal_lebih' => $jumlah_lebih,
                    'nominal_kurang' => $jumlah_kurang

                ]);
            }
        }






        // $spp = $this->PembayaranModel->save(['id_spp' => $this->request->getVar('id_spp')]);

        // if ($spp >= $jumlah_bayarr) {
        // }



        session()->setFlashdata('pesan', 'data  berhasil di tambahkan');

        return redirect()->to('/pembayaran/readpembayaran/');
    }
    public function editpembayaran($pembayaran)
    {
        $tahun = date('Y');
        $date = $this->SppModel->where('tahun', $tahun)->find();
        $id_spp = $date[0]['id_spp'];
        $nominal = $date[0]['nominal'];
        $tahun = $date[0]['tahun'];

        $data = [
            'title' => 'create (siswa) | MTSN 3 Jakarta Selatan',
            'validation' => \Config\Services::validation(),
            'home' => $this->PembayaranModel->getPembayaran($pembayaran),
            'id_spp' => $id_spp,
            'nominal' => $nominal,
            'tahun' => $tahun,
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
                    'is_unique' => '{field}  tanggal ini sudah bayar!!',
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
