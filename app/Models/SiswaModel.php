<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $db;
    protected $table = 'siswa';
    protected $primaryKey = 'nisn';
    protected $allowedFields = ['nisn', 'nis', 'nama', 'id_kelas', 'alamat', 'no_telp'];

    public function search($keyword)
    {
        $builder = $this->table('siswa');
        $builder->like('nama', $keyword);
        return $builder;
    }

    public function getSiswa($nisn = false)
    {
        if ($nisn == false) {
            return $this->findAll();
        }
        return $this->where(['nisn' => $nisn])->first();
    }

    public function tot_siswa($nisn = false)
    {
        if ($nisn == false) {
            return $this->countAll();
        }
        return $this->where(['nisn' => $nisn])->first();
    }
}
