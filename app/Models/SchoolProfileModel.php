<?php

namespace App\Models;

use CodeIgniter\Model;

class SchoolProfileModel extends Model
{
    protected $table            = 'school_profiles';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'school_name',
        'slogan',
        'description',
        'logo',
        'favicon',
        'address',
        'phone',
        'email',
        'website',
        'social_media',
        'vision',
        'mission',
        'principal_name',
        'principal_photo',
        'principal_welcome',
        'established_year',
        'accreditation',
        'map_embed',
        'meta_keywords',
        'meta_description',
        'is_active',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = '';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'school_name' => 'required|min_length[3]|max_length[255]',
        'email'       => 'permit_empty|valid_email',
    ];

    /**
     * Clear profile cache on save
     */
    protected $afterInsert = ['clearProfileCache'];
    protected $afterUpdate = ['clearProfileCache'];
    protected $afterDelete = ['clearProfileCache'];

    protected function clearProfileCache(array $data)
    {
        \Config\Services::cache()->delete('school_profile_active');
        return $data;
    }
}
