<?php

namespace App\Models;

use CodeIgniter\Model;

class SchoolAppModel extends Model
{
    protected $table            = 'school_apps';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name',
        'description',
        'icon',
        'url',
        'category',
        'display_order',
        'is_active',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'name' => 'required|min_length[2]|max_length[150]',
        'url'  => 'required|valid_url',
    ];

    public function getActiveApps()
    {
        return $this->where('is_active', 1)
            ->orderBy('display_order', 'ASC')
            ->findAll();
    }
}
