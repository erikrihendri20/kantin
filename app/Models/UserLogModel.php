<?php

namespace App\Models;

use CodeIgniter\Model;

class UserLogModel extends Model
{
    protected $table      = 'user_log';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['user_id'];

    protected $protectFields = false;

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getVisitor()
    {
        date_default_timezone_set('Asia/Jakarta');
        $start_date = date("Y-m-d H:i:s", strtotime("-30 minutes"));
        $end_date = date("Y-m-d H:i:s");
        return $this->builder()
        ->select("DISTINCT(user_id)")
        ->where('updated_at BETWEEN "'. $start_date. '" and "'. $end_date.'"')
        ->get()->getResultArray();
    }
}