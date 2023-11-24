<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['firstname', 'lastname', 'username', 'email', 'password', 'role', 'status'];


    // Validation
    protected $validationRules      = [
        'firstname'  => 'required|min_length[3]|max_length[100]',
        'lastname'   => 'required|min_length[3]|max_length[100]',
        'username'   => 'required|min_length[3]|max_length[50]',
        'email'      => 'required|min_length[3]|max_length[50]',
        'password'   => 'required|min_length[8]|max_length[255]',
        'role'       => 'required',
        'status'     => 'required',
    ];

    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
