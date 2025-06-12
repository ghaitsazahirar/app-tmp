<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'admins';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['name', 'email', 'password'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Optional: tambahkan rules validasi
    protected $validationRules    = [
        'name'     => 'required|min_length[3]',
        'email'    => 'required|valid_email|is_unique[admins.email,id,{id}]',
        'password' => 'required|min_length[6]',
    ];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}
