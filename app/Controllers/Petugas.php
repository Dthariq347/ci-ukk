<?php

namespace App\Controllers;

class Petugas extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'petugas | MTSN 3 Jakarta Selatan',
            'siswa' => $this->SiswaModel->countAll(),
            'kelas' => $this->KelasModel->countAll(),
            'users' => $this->PetugasModel->countAll(),
        ];
        return view('petugas/index', $data);
    }
}
