<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasModel extends Model
{
    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';

    protected $allowedFields = ['nama_kelas'];

    public function getKelas($kelas = false)
    {
        if ($kelas == false) {
            return $this->findAll();
        }
        return $this->where(['id_kelas' => $kelas])->first();
    }
    public function search($keyword)
    {
        $builder = $this->table('kelas');
        $builder->like('nama_kelas', $keyword);
        return $builder;
    }
}
