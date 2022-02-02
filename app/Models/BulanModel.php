<?php

namespace App\Models;

use CodeIgniter\Model;

class BulanModel extends Model
{
    protected $table = 'bulan';

    protected $allowedFields = ['bulan_bayar'];

    public function getBulan($bulan = false)
    {
        if ($bulan == false) {
            return $this->findAll();
        }
        return $this->where(['bulan_bayar' => $bulan])->first();
    }
}
