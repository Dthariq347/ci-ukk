<?php

namespace App\Controllers;


use Myth\Auth\Password;

class Admin extends BaseController
{
    protected $db, $builder;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }
    // public function index()
    // {
    //     // $logout = 	$auth->logout();
    //     $data['title'] = 'admin | MTSN 3 Jakarta Selatan';
    //     if (!logged_in()) {
    //         return view('login/admin', $data);
    //     } else {
    //         if (in_groups('siswa')) {
    //             return redirect()->to('/login/siswa');
    //         }
    //     }

    //     return view('/admin/index',);
    // }
    public function createsiswa()
    {
        $data = [
            'title' => 'create (siswa) | MTSN 3 Jakarta Selatan',
            'validation' => \Config\Services::validation(),
            'jamet' => $this->KelasModel->getKelas(),


        ];
        return view('/admin/mengelola/siswa/index', $data);
    }
    public function readsiswa()
    {
        $currentPage = $this->request->getVar('page_siswa') ? $this->request->getVar('page_siswa') : 1;
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $siswa = $this->SiswaModel->search($keyword);
        } else {
            $siswa = $this->SiswaModel;
        }
        $data = [
            'title' => 'Read | Web Dzabitha',
            'read' => $siswa
                ->select('nisn, nis, nama, nama_kelas, alamat, no_telp')
                ->join('kelas', 'kelas.id_kelas = siswa.id_kelas')
                ->orderBy('nisn', 'ASC')
                ->paginate(3, 'siswa'),
            'pager' => $this->SiswaModel->pager,
            'currentPage' => $currentPage
        ];

        // $this->builder = $this->db->table('siswa');
        // $this->builder->select('nisn, nis, nama, nama_kelas, alamat, no_telp, nominal');
        // $this->builder->join('kelas', 'kelas.id_kelas = siswa.id_kelas');
        // $this->builder->join('spp', 'spp.id_spp = siswa.id_spp');
        // $query = $this->builder->get();

        // $data['read'] = $query->getResultArray();
        return view('admin/mengelola/siswa/read', $data);
    }
    public function savesiswa()
    {

        //validasi input 
        if (!$this->validate([
            'nisn' => [
                'rules' => 'required|integer',
                'errors' => [
                    'required' => '{field}  wajib di isi!!',
                    'integer' => '{field} harus berupa angka!!'
                ]
            ],
            'nis' => [
                'rules' => 'required|integer',
                'errors' => [
                    'required' => '{field}  wajib di isi!!',
                    'integer' => '{field} harus berupa angka!!'
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field}  wajib di isi!!'
                ]
            ],


            'no_telp' => [
                'rules' => 'required|integer',
                'errors' => [
                    'required' => '{field}  wajib di isi!!',
                    'integer' => '{field} harus berupa angka!!'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi!!',
                ]
            ],
            'id_kelas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Kelas wajib di isi!!',
                ]
            ],

        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to('/home/contact/')->withInput()->with('validation', $validation);
            return redirect()->to('/admin/createsiswa/')->withInput();
        }

        $data = [
            'nisn' => $this->request->getVar('nisn'),
            'nis' => $this->request->getVar('nis'),
            'nama' => $this->request->getVar('nama'),
            'id_kelas' => $this->request->getVar('id_kelas'),
            'alamat' => $this->request->getVar('alamat'),
            'no_telp' => $this->request->getVar('no_telp'),
        ];

        $this->SiswaModel->insert($data);

        // Flashdata 

        session()->setFlashdata('pesan', 'data siswa berhasil di tambahkan');

        return redirect()->to('/admin/readsiswa/');
    }
    public function deletesiswa($id)
    {
        $this->SiswaModel->delete($id);
        session()->setFlashdata('pesan', 'data siswa berhasil di hapus');
        return redirect()->to('/admin/readsiswa/');
    }
    public function editsiswa($siswa)
    {
        $data = [
            'title' => 'Edit (jabatan) | KEPEGAWAIAN',
            'validation' => \Config\Services::validation(),
            'home' => $this->SiswaModel->getSiswa($siswa),
            'jamet' => $this->KelasModel->getKelas()
        ];
        return view('/admin/mengelola/siswa/edit', $data);
    }
    public function updatesiswa($siswa)
    {
        // validation
        if (!$this->validate([
            'nisn' => [
                'rules' => 'required|integer',
                'errors' => [
                    'required' => '{field}  wajib di isi!!',
                    'integer' => '{field} harus berupa angka!!'
                ]
            ],
            'nis' => [
                'rules' => 'required|integer',
                'errors' => [
                    'required' => '{field}  wajib di isi!!',
                    'integer' => '{field} harus berupa angka!!'
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field}  wajib di isi!!'
                ]
            ],


            'no_telp' => [
                'rules' => 'required|integer',
                'errors' => [
                    'required' => '{field}  wajib di isi!!',
                    'integer' => '{field} harus berupa angka!!'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} wajib di isi!!',
                ]
            ],
            'id_kelas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Kelas wajib di isi!!',
                ]
            ],
        ])) {

            // $validation = \Config\Services::validation();
            // return redirect()->to('/home/edit/' . $this->request->getVar('id'))->withInput()->with('validation', $validation);
            return redirect()->to('/admin/editsiswa/' . $this->request->getVar('nisn'))->withInput();
        }

        // input/output
        $this->SiswaModel->save([
            'nisn' => $siswa,
            'nis' => $this->request->getVar('nis'),
            'nama' => $this->request->getVar('nama'),
            'id_kelas' => $this->request->getVar('id_kelas'),
            'alamat' => $this->request->getVar('alamat'),
            'no_telp' => $this->request->getVar('no_telp')

        ]);
        // Flashdata 

        session()->setFlashdata('pesan', 'data siswa berhasil di ubah');

        return redirect()->to('/admin/readsiswa/');
    }
    // System KELAS 
    public function createkelas()
    {
        $data = [
            'title' => 'create (kelas) | MTSN 3 Jakarta Selatan',
            'validation' => \Config\Services::validation()
        ];
        return view('admin/mengelola/kelas/index', $data);
    }
    public function readkelas()
    {

        // $read = $this->ReadModel->findAll();
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $kelas = $this->KelasModel->search($keyword);
        } else {
            $kelas = $this->KelasModel;
        }
        $data = [
            'title' => 'Read (kelas) | Web Dzabitha',
            'read' => $kelas->paginate(3, 'kelas'),
            'pager' => $this->KelasModel->pager,
        ];

        return view('admin/mengelola/kelas/read', $data);
    }
    public function savekelas()
    {
        //validasi input 
        if (!$this->validate([
            'nama_kelas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field}  wajib di isi!!',
                ]
            ],

        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to('/home/contact/')->withInput()->with('validation', $validation);
            return redirect()->to('/admin/createkelas/')->withInput();
        }


        $this->KelasModel->save([
            'nama_kelas' => $this->request->getVar('nama_kelas')


        ]);

        // Flashdata 

        session()->setFlashdata('pesan', 'data kelas berhasil di tambahkan');

        return redirect()->to('/admin/readkelas/');
    }
    public function deletekelas($id)
    {


        $this->KelasModel->delete($id);
        session()->setFlashdata('pesan', 'data kelas berhasil di hapus');
        return redirect()->to('/admin/readkelas/');
    }
    public function editkelas($kelas)
    {
        $data = [
            'title' => 'Edit (jabatan) | KEPEGAWAIAN',
            'validation' => \Config\Services::validation(),
            'home' => $this->KelasModel->getKelas($kelas)
        ];
        return view('/admin/mengelola/kelas/edit', $data);
    }
    public function updatekelas($kelas)
    {
        // validation
        if (!$this->validate([
            'nama_kelas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field}  wajib di isi!!',
                ]
            ]
        ])) {

            // $validation = \Config\Services::validation();
            // return redirect()->to('/home/edit/' . $this->request->getVar('id'))->withInput()->with('validation', $validation);
            return redirect()->to('/admin/editkelas/' . $this->request->getVar('id_kelas'))->withInput();
        }

        // input/output
        $this->KelasModel->save([
            'id_kelas' => $kelas,
            'nama_kelas' => $this->request->getVar('nama_kelas')

        ]);
        // Flashdata 

        session()->setFlashdata('pesan', 'data kelas berhasil di ubah');

        return redirect()->to('/admin/readkelas/');
    }
    // System PETUGAS
    public function createpetugas()
    {
        $data = [
            'title' => 'create (petugas) | MTSN 3 Jakarta Selatan',
            'validation' => \Config\Services::validation()
        ];
        $this->RoleModel->select('id, name');
        $this->RoleModel->where('id != 3');
        $coba = $this->RoleModel->get();

        $data['role'] = $coba->getResultArray();
        return view('admin/mengelola/petugas/index', $data);
    }
    public function readpetugas()
    {

        // $read = $this->ReadModel->findAll();
        $currentPage = $this->request->getVar('page_users') ? $this->request->getVar('page_users') : 1;
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $petugas = $this->PetugasModel->search($keyword);
        } else {
            $petugas = $this->PetugasModel;
        }
        $data = [
            'title' => 'Read | Web Dzabitha',
            'users' => $petugas
                ->select('users.id as id_user ,email, username, fullname, name')
                ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
                ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')
                ->where('users.id !=', user_id())
                ->where('auth_groups.id !=', 3)
                ->paginate(3, 'users'),
            'pager' => $this->PetugasModel->pager,
            'currentPage' => $currentPage


        ];
        // $this->builder = $this->db->table('users');
        // $this->builder->select('users.id as id_user ,email, username, fullname, name');
        // $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        // $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        // $this->builder->where('users.id !=', user_id());
        // $this->builder->where('auth_groups.id !=', 3);
        // $query = $this->builder->get();

        // $data['users'] = $query->getResultArray();
        return view('admin/mengelola/petugas/read', $data);
    }
    public function savepetugas()
    {
        //validasi input 
        if (!$this->validate([
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => '{field}  wajib di isi!!',
                    'valid_email' => 'Alamat {field} anda kurang tepat!!',
                ]
            ],
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field}  wajib di isi!!',
                ]
            ],
            'fullname' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field}  wajib di isi!!',
                ]
            ],
            'password_hash' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'password wajib di isi!!',
                ]
            ],
            'id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Role wajib di isi!!',
                ]
            ],

        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to('/home/contact/')->withInput()->with('validation', $validation);
            return redirect()->to('/admin/createpetugas/')->withInput();
        }


        $petugas = [
            'email' => $this->request->getVar('email'),
            'username' => $this->request->getVar('username'),
            'fullname' => $this->request->getVar('fullname'),
            'password_hash' => Password::hash($this->request->getVar('password_hash')),
            'active' => 1
        ];


        $this->PetugasModel->insert($petugas);
        $lastid = $this->PetugasModel->insertID();

        $groups = [
            'group_id' => $this->request->getVar('id'),
            'user_id' => $lastid
        ];

        $this->GroupsModel->insert($groups);
        // Flashdata 

        session()->setFlashdata('pesan', 'data admin / petugas berhasil di tambahkan');

        return redirect()->to('/admin/readpetugas/');
    }
    public function deletepetugas($id)
    {
        $this->PetugasModel->delete($id);
        session()->setFlashdata('pesan', 'data admin / petugas berhasil di hapus');
        return redirect()->to('/admin/readpetugas/');
    }
    public function editpetugas($petugas)
    {
        $data = [
            'title' => 'Edit (jabatan) | KEPEGAWAIAN',
            'validation' => \Config\Services::validation(),
            'home' => $this->PetugasModel->getPetugas($petugas),
            'role' => $this->RoleModel->getRole()
        ];
        return view('/admin/mengelola/petugas/edit', $data);
    }
    public function updatepetugas($petugas)
    {
        // validation
        if (!$this->validate([
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field}  wajib di isi!!',
                ]
            ],
            'password_hash' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field}  wajib di isi!!',
                ]
            ],
        ])) {

            // $validation = \Config\Services::validation();
            // return redirect()->to('/home/edit/' . $this->request->getVar('id'))->withInput()->with('validation', $validation);
            return redirect()->to('/admin/editpetugas/' . $this->request->getVar('id'))->withInput();
        }

        // input/output
        $this->PetugasModel->save([
            'id' => $petugas,
            'email' => $this->request->getVar('email'),
            'username' => $this->request->getVar('username'),
            'password_hash' => Password::hash($this->request->getVar('password_hash')),

        ]);
        // Flashdata 

        session()->setFlashdata('pesan', 'data admin / petugas berhasil di ubah');

        return redirect()->to('/admin/readpetugas/');
    }
    // System SPP
    public function createspp()
    {
        $data = [
            'title' => 'create (spp) | MTSN 3 Jakarta Selatan',
            'validation' => \Config\Services::validation()
        ];
        return view('admin/mengelola/spp/index', $data);
    }
    public function readspp()
    {

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $spp = $this->SppModel->search($keyword);
        } else {
            $spp = $this->SppModel;
        }

        // $read = $this->ReadModel->findAll();
        $data = [
            'title' => 'Read (spp) | Web Dzabitha',
            'read' => $spp->paginate(3, 'spp'),
            'pager' => $this->SppModel->pager,
        ];

        return view('admin/mengelola/spp/read', $data);
    }
    public function savespp()
    {
        //validasi input 
        $nominal = $this->request->getVar('nominal');
        $noms = str_replace('.', '', $nominal);
        if (!$this->validate([
            'tahun' => [
                'rules' => 'required|integer',
                'errors' => [
                    'required' => '{field}  wajib di isi!!',
                    'integer' => ' {field} wajib di isi!!'
                ]
            ],
            'nominal' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field}  wajib di isi!!'
                ]
            ],

        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to('/home/contact/')->withInput()->with('validation', $validation);
            return redirect()->to('/admin/createspp/')->withInput();
        }
        $this->SppModel->save([
            'tahun' => $this->request->getVar('tahun'),
            'nominal' => $noms,


        ]);

        // Flashdata 

        session()->setFlashdata('pesan', 'data spp berhasil di tambahkan');

        return redirect()->to('/admin/readspp/');
    }
    public function deletespp($id)
    {


        $this->SppModel->delete($id);
        session()->setFlashdata('pesan', 'data spp berhasil di hapus');
        return redirect()->to('/admin/readspp/');
    }
    public function editspp($spp)
    {
        $data = [
            'title' => 'Edit (jabatan) | KEPEGAWAIAN',
            'validation' => \Config\Services::validation(),
            'home' => $this->SppModel->getspp($spp)
        ];
        return view('/admin/mengelola/spp/edit', $data);
    }
    public function updatespp($spp)
    {
        // validation
        $nominal = $this->request->getVar('nominal');
        $noms = str_replace('.', '', $nominal);
        if (!$this->validate([
            'tahun' => [
                'rules' => 'required|integer',
                'errors' => [
                    'required' => '{field}  wajib di isi!!',
                    'integer' => ' {field} wajib di isi!!'
                ]
            ],
            'nominal' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field}  wajib di isi!!',
                    'numeric' => '{field} wajib di isi!!'
                ]
            ],
        ])) {

            // $validation = \Config\Services::validation();
            // return redirect()->to('/home/edit/' . $this->request->getVar('id'))->withInput()->with('validation', $validation);
            return redirect()->to('/admin/editspp/' . $this->request->getVar('id_spp'))->withInput();
        }

        // input/output
        $this->SppModel->save([
            'id_spp' => $spp,
            'tahun' => $this->request->getVar('tahun'),
            'nominal' => $noms

        ]);
        // Flashdata 

        session()->setFlashdata('pesan', 'data spp berhasil di ubah');

        return redirect()->to('/admin/readspp/');
    }



    public function createakun()
    {
        $data = [
            'title' => 'create (petugas) | MTSN 3 Jakarta Selatan',
            'validation' => \Config\Services::validation(),
            'home' => $this->SiswaModel->getSiswa(),
        ];
        $this->RoleModel->select('id, name');
        $this->RoleModel->where('id', 3);
        $coba = $this->RoleModel->get();

        $data['role'] = $coba->getResultArray();
        return view('akun/index', $data);
    }
    public function readakun()
    {

        // $read = $this->ReadModel->findAll();\
        $currentPage = $this->request->getVar('page_users') ? $this->request->getVar('page_users') : 1;
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $petugas = $this->PetugasModel->search($keyword);
        } else {
            $petugas = $this->PetugasModel;
        }
        $data = [
            'title' => 'Read | Web Dzabitha',

            'users' => $petugas
                ->select('users.id as id_user ,email, username, fullname, name')
                ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
                ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')
                ->where('users.id !=', user()->id)
                ->where('auth_groups.id =', 3)
                ->orderBy('id_user', 'ASC')
                ->paginate(3, 'users'),
            'pager' => $this->PetugasModel->pager,
            'currentPage' => $currentPage
        ];
        // $this->builder = $this->db->table('users');
        // $this->builder->select('users.id as id_user ,email, username, fullname, name');
        // $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        // $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        // $this->builder->where('users.id !=', user()->id);
        // $this->builder->where('auth_groups.id =', 3);
        // $query = $this->builder->get();

        // $data['users'] = $query->getResultArray();
        return view('akun/read', $data);
    }
    public function saveakun()
    {
        //validasi input 
        if (!$this->validate([
            'email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field}  wajib di isi!!',
                ]
            ],
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field}  wajib di isi!!',
                ]
            ],
            'fullname' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field}  wajib di isi!!',
                ]
            ],
            'password_hash' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field}  wajib di isi!!',
                ]
            ],

        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to('/home/contact/')->withInput()->with('validation', $validation);
            return redirect()->to('/admin/createakun/')->withInput();
        }


        $petugas = [
            'email' => $this->request->getVar('email'),
            'username' => $this->request->getVar('username'),
            'fullname' => $this->request->getVar('fullname'),
            'password_hash' => Password::hash($this->request->getVar('password_hash')),
            'active' => 1
        ];


        $this->PetugasModel->insert($petugas);
        $lastid = $this->PetugasModel->insertID();

        $groups = [
            'group_id' => $this->request->getVar('id'),
            'user_id' => $lastid
        ];

        $this->GroupsModel->insert($groups);
        // Flashdata 

        session()->setFlashdata('pesan', 'data kontak berhasil di tambahkan');

        return redirect()->to('/admin/readakun/');
    }
    public function deleteakun($id)
    {
        $this->PetugasModel->delete($id);
        session()->setFlashdata('pesan', 'data petugas berhasil di hapus');
        return redirect()->to('/admin/readakun/');
    }
    public function editakun($petugas)
    {
        $data = [
            'title' => 'Edit (jabatan) | KEPEGAWAIAN',
            'validation' => \Config\Services::validation(),
            'home' => $this->PetugasModel->getPetugas($petugas),
            'role' => $this->RoleModel->getRole()
        ];
        return view('/akun/edit', $data);
    }
    public function updateakun($petugas)
    {
        // validation
        if (!$this->validate([
            'email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field}  wajib di isi!!',
                ]
            ],
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field}  wajib di isi!!',
                ]
            ],
            'password_hash' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field}  wajib di isi!!',
                ]
            ],
        ])) {

            // $validation = \Config\Services::validation();
            // return redirect()->to('/home/edit/' . $this->request->getVar('id'))->withInput()->with('validation', $validation);
            return redirect()->to('/admin/editakun/' . $this->request->getVar('id'))->withInput();
        }

        // input/output
        $this->PetugasModel->save([
            'id' => $petugas,
            'email' => $this->request->getVar('email'),
            'username' => $this->request->getVar('username'),
            'password_hash' => Password::hash($this->request->getVar('password_hash')),

        ]);
        // Flashdata 1

        session()->setFlashdata('pesan', 'data petugas berhasil di ubah');

        return redirect()->to('/admin/readakun/');
    }
}
