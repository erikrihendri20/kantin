<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table      = 'transaction';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['status' , 'user_id'];

    protected $protectFields = false;

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function checkTransaction($user_id , $status=null)
    {
        if($status){
            return $this->builder()
            ->where('status' , $status)
            ->where('user_id' , $user_id)
            ->get()->getRowArray();
        }else{
            return $this->builder()
            ->where('user_id' , $user_id)
            ->get()->getRowArray();
        }
    }
    
    public function takeOrder($transaction_id , $status)
    {
        return $this->builder()
        ->set('status', $status)
        ->where('id',$transaction_id)
        ->update();
    }

}