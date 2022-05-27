<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionTopingModel extends Model
{
    protected $table      = 'transaction_toping';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['transaction_menu_id' , 'toping_id' , 'price'];

    protected $protectFields = false;

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function checkToping($transaction_menu_id , $toping_id)
    {
        return $this->builder()
        ->where('transaction_menu_id' , $transaction_menu_id)
        ->where('toping_id' , $toping_id)
        ->get()
        ->getRowArray();
    }
    
    public function getTopingTransaction($user_id , $status , $date=null)
    {
        if($date){
            return $this->builder()
            ->join('transaction_menu' , 'transaction_toping.transaction_menu_id=transaction_menu.id')
            ->join('transaction' , 'transaction_menu.transaction_id=transaction.id')
            ->join('toping' , 'transaction_toping.toping_id=toping.id')
            ->whereIn('transaction.status',$status)
            ->where('transaction.user_id',$user_id)
            ->select('transaction_toping.id as id , transaction_menu.id as transaction_menu_id , transaction_menu.menu_id as menu_id , toping.name as name ,
            transaction_toping.toping_id as toping_id , transaction_toping.price , toping.status as status')
            ->where('transaction.updated_at BETWEEN "'. $date['start-date'].' 23:59:59'. '" and "'. $date['end-date'].' 23:59:59'.'"')
            ->get()
            ->getResultArray();
        }
        return $this->builder()
        ->join('transaction_menu' , 'transaction_toping.transaction_menu_id=transaction_menu.id')
        ->join('transaction' , 'transaction_menu.transaction_id=transaction.id')
        ->join('toping' , 'transaction_toping.toping_id=toping.id')
        ->whereIn('transaction.status',$status)
        ->where('transaction.user_id',$user_id)
        ->select('transaction_toping.id as id , transaction_menu.id as transaction_menu_id , transaction_menu.menu_id as menu_id , toping.name as name ,
        transaction_toping.toping_id as toping_id , transaction_toping.price , toping.status')
        ->get()
        ->getResultArray();
        
    }
    
    public function getTopingOrderList($canteen_id , $status , $length , $index)
    {
        return $this->builder()
        ->join('transaction_menu' , 'transaction_toping.transaction_menu_id=transaction_menu.id')
        ->join('transaction' , 'transaction_menu.transaction_id=transaction.id')
        ->join('toping' , 'transaction_toping.toping_id=toping.id')
        ->whereIn('transaction.status',$status)
        ->where('transaction.canteen_id',$canteen_id)
        ->limit($length,$index)
        ->select('transaction_toping.id as id , transaction_menu.id as transaction_menu_id , transaction_menu.menu_id as menu_id , toping.name as name ,
        transaction_toping.toping_id as toping_id , transaction_toping.price, toping.status as status')
        ->get()
        ->getResultArray();
        
    }

    public function deleteTopingCart($transaction_id)
    {   
        return $this->db->query(
            '
                DELETE 
                FROM `transaction_toping` 
                WHERE transaction_menu_id IN (
                    SELECT id
                    FROM transaction_menu
                    WHERE transaction_toping.transaction_menu_id=transaction_menu.id AND
                    transaction_menu.transaction_id='.$transaction_id.')
            '
        );
    }

    
}