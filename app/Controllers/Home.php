<?php

namespace App\Controllers;

class Home extends BaseController
{
    protected $db, $builder;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }
    public function index()
    {
        $data['title'] = 'admin | MTSN 3 Jakarta Selatan';

        if (in_groups('siswa')) {
            return redirect()->to('/login/siswa');
        } else {
            if (in_groups('admin') || in_groups('petugas')) {
                return redirect()->to('/login/admin');
            };
        }

        return view('/main/main', $data);
    }
    public function admin()
    {
        $data['title'] = 'admin | MTSN 3 Jakarta Selatan';

        if (in_groups('siswa')) {
            return redirect()->to('/login/siswa');
        } else {
            if (in_groups('admin') || in_groups('petugas')) {
                return redirect()->to('/login/admin');
            };
        }

        return view('/admin/index', $data);
    }
}
