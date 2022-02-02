<?php

namespace App\Models;

use CodeIgniter\Model;

class StatusModel extends Model
{
    protected $table = 'status';
    protected $primaryKey = 'id_status';
    protected $allowedFields = ['id_status, status_pembayaran'];

    public function getstatus($status = false)
    {
        if ($status == false) {
            return $this->findAll();
        }
        return $this->where(['id_status' => $status])->first();
    }
}
