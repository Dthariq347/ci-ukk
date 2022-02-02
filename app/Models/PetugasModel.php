<?php

namespace App\Models;

use CodeIgniter\Model;

class PetugasModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['email', 'petugas', 'username', 'fullname', 'password_hash', 'active'];
    public function getPetugas($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }
    public function search($keyword)
    {
        $builder = $this->table('users');
        $builder->like('username', $keyword);
        return $builder;
    }
}
