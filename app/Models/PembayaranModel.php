<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
{
    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';

    protected $allowedFields = ['id', 'siswa', 'nisn', 'tgl_bayar', 'bln_bayar', 'thn_bayar', 'id_spp', 'jumlah_bayar', 'id_status'];

    public function getPembayaran($pembayaran = false)
    {
        if ($pembayaran == false) {
            return $this->findAll();
        }
        return $this->where(['id_pembayaran' => $pembayaran])->first();
    }
    public function search($keyword)
    {
        $builder = $this->table('pembayaran');
        $builder->like('nama', $keyword);
        return $builder;
    }
}
