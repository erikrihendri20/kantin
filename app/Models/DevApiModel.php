<?php

namespace App\Models;

use CodeIgniter\Model;

class DevApiModel extends Model
{
    protected $table      = 'dev_api';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['dev_user_id', 'application_name', 'api_key' , 'url' , 'information' , 'application_type'];

    protected $protectFields = false;

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    
}