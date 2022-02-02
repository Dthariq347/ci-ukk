<?php

namespace App\Models;

use CodeIgniter\Model;

class SppModel extends Model
{
    protected $table = 'spp';
    protected $primaryKey = 'id_spp';
    protected $allowedFields = ['tahun', 'nominal'];

    public function getspp($spp = false)
    {
        if ($spp == false) {
            return $this->findAll();
        }
        return $this->where(['id_spp' => $spp])->first();
    }
    public function search($keyword)
    {
        $builder = $this->table('spp');
        $builder->like('tahun', $keyword);
        return $builder;
    }
}
