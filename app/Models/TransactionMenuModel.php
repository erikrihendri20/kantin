<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionMenuModel extends Model
{
    protected $table      = 'transaction_menu';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['menu_id' , 'name' , 'count' , 'price' , 'transaction_id'];

    protected $protectFields = false;

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function checkMenu($transaction_id , $menu_id=null)
    {
        if($menu_id){
            return $this->builder()
            ->where('transaction_id' , $transaction_id)
            ->where('menu_id' , $menu_id)
            ->get()->getRowArray();
        }
        return $this->builder()
        ->where('transaction_id' , $transaction_id)
        ->get()->getResultArray();
    }

    public function getCartTotal($user_id)
    {
        return $this->builder()
        ->join('transaction' , 'transaction_menu.transaction_id=transaction.id')
        ->where('transaction.status' , 1)
        ->where('transaction.user_id' , $user_id)
        ->select('SUM(price) as total_price , SUM(count) as total_menu')
        ->get()
        ->getRowArray();
    }

    public function getMenuTransaction($user_id)
    {
        return $this->builder()
        ->join('transaction' , 'transaction_menu.transaction_id=transaction.id')
        ->where('transaction.status' , 1)
        ->where('transaction.user_id' , $user_id)
        ->get()
        ->getResultArray();
    }

    public function getItemCart($user_id)
    {
        return $this->builder()
        ->join('transaction' , 'transaction_menu.transaction_id=transaction.id')
        ->join('menu','transaction_menu.menu_id=menu.id')
        ->where('transaction.status' , 1)
        ->where('transaction.user_id' , $user_id)
        ->select('
        transaction.id as id , 
        menu.id as menu_id , 
        menu.name as menu_name , 
        transaction_menu.count as count ,
        transaction_menu.price as price , 
        transaction.user_id as user_id , 
        menu.description as menu_description , 
        menu.photo as photo')
        ->get()
        ->getResultArray();
    }
    
}