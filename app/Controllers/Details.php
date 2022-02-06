<?php

namespace App\Controllers;

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
        ];
        return view('perdetails/index', $data);
    }


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
