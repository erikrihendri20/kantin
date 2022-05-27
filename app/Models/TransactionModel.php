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

    protected $allowedFields = ['status' , 'user_id' , 'time_estimate' , 'testimonial'];

    protected $protectFields = false;

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function checkTransaction($user_id , $canteen_id=null , $status=null)
    {
        if($status){
            $this->builder()
            ->where('status' , $status)
            ->where('user_id' , $user_id);
        }else{
            $this->builder()
            ->where('user_id' , $user_id);
        }
        if(!$canteen_id){
            return $this->builder()
            ->get()->getResultArray();
        }
        return $this->builder()
        ->where('canteen_id' , $canteen_id)
        ->get()->getRowArray();
    }
    
    public function takeOrder($transaction_id , $status)
    {
        return $this->builder()
        ->set('status', $status)
        ->where('id',$transaction_id)
        ->update();
    }

}