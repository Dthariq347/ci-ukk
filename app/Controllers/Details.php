<?php

namespace App\Controllers;

use Myth\Auth\Password;

class Details extends BaseController
{
    protected $db, $builder;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $data = [
            'title' => 'login | MTSN 3 Jakarta Selatan',
            'validation' => \Config\Services::validation(),
        ];


        return view('perdetails/index', $data);
    }
    public function savepassword($petugas)
    {


        $this->PetugasModel->save([
            'id' => $petugas,
            'password_hash' => Password::hash($this->request->getVar('password_hash')),

        ]);

        session()->setFlashdata('pesan', 'password siswa berhasil di ubah');

        return redirect()->to('/details/index/');
    }

    // public function index($petugas)
    // {
    //     $data = [
    //         'title' => 'Edit (jabatan) | KEPEGAWAIAN',
    //         'validation' => \Config\Services::validation(),
    //         'home' => $this->PetugasModel->getPetugas($petugas)
    //     ];
    //     return view('perdetails/index', $data);
    // }
    // public function updateakun($petugas)
    // {
    //     // validation
    //     if (!$this->validate([
    //         'password_hash' => [
    //             'rules' => 'required',
    //             'errors' => [
    //                 'required' => '{field}  wajib di isi!!',
    //             ]
    //         ],
    //     ])) {

    //         // $validation = \Config\Services::validation();
    //         // return redirect()->to('/home/edit/' . $this->request->getVar('id'))->withInput()->with('validation', $validation);
    //         return redirect()->to('/details/index/' . $this->request->getVar('id'))->withInput();
    //     }

    //     // input/output
    //     $this->PetugasModel->save([
    //         'id' => $petugas,
    //         'password_hash' => Password::hash($this->request->getVar('password_hash')),

    //     ]);
    //     // Flashdata 1

    //     session()->setFlashdata('pesan', 'data petugas berhasil di ubah');

    //     return redirect()->to('/admin/readakun/');
    // }
    public function siswa()
    {
        $data = [
            'title' => 'login | MTSN 3 Jakarta Selatan',
            'siswa' => $this->SiswaModel->countAll(),
            'kelas' => $this->KelasModel->countAll(),
            'users' => $this->PetugasModel->countAll(),
        ];
        return view('siswa/index', $data);
    }
}
