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
        $data = [
            'title' => 'Index | MTSN 3 Jakarta Selatan',
        ];
        return view('main/index', $data);
    }
    public function admin()
    {

        $data = [
            'title' => 'Index | MTSN 3 Jakarta Selatan',
        ];
        return view('templates/dashboard', $data);
    }
}
