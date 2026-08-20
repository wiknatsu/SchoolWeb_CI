<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'username',
        'email',
        'password_hash',
        'full_name',
        'role',
        'avatar',
        'is_active',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'username'  => 'required|min_length[3]|max_length[100]|is_unique[users.username,id,{id}]',
        'email'     => 'required|valid_email|is_unique[users.email,id,{id}]',
        'full_name' => 'required|min_length[3]|max_length[150]',
        'role'      => 'required|in_list[superadmin,admin,editor]',
    ];
    protected $validationMessages   = [
        'username' => [
            'is_unique' => 'Username ini sudah digunakan.',
            'required'  => 'Username wajib diisi.',
        ],
        'email' => [
            'is_unique' => 'Email ini sudah terdaftar.',
            'valid_email' => 'Format email tidak valid.',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;
}
