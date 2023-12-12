<?php

namespace App\Models;

use CodeIgniter\Model;

class Ticket extends Model
{
    protected $table            = 'tickets';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'office_id', 'ticket_firstname', 'ticket_lastname', 'ticket_email', 'ticket_severity_id', 'ticket_description', 'ticket_status_id'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'user_id'               => 'required|integer',
        'office_id'             => 'required|integer',
        'ticket_firstname'      => 'required|min_length[3]|max_length[255]',
        'ticket_lastname'       => 'required|min_length[3]|max_length[255]',
        'ticket_email'          => 'required',
        'ticket_severity_id'    => 'required|integer',
        'ticket_description'    => 'required|min_length[3]|max_length[255]',
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

    protected $returnTypeRelations = 'array';
    protected $belongsTo = [
        'office' => [
            'model'         => 'App\Models\Office',
            'foreign_key'   => 'office_id',
            'local_key'     => 'id'
        ],
        'category' => [
            'model'         => 'App\Models\Category',
            'foreign_key'   => 'ticket_severity_id',
            'local_key'     => 'id'
        ],
        'users' => [
            'model'         => 'App\Models\User',
            'foreign_key'   => 'user_id',
            'local_key'     => 'id'
        ],
    ];
}
