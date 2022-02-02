<?php

namespace App\Models;

use CodeIgniter\Model;

class HomeModel extends Model
{
    public function tot_siswa()
    {
        return $this->db->table('siswa')->countAll();
    }
    public function tot_kelas()
    {
        return $this->db->table('kelas')->countAll();
    }
}
