<?php

namespace App\Models;

use CodeIgniter\Database\BaseBuilder;
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
    }

    public function getMenuTransaction($user_id , $status , $date=null)
    {
        $this->builder()->select('menu.time_estimate as time_estimate, menu.status as status')
        ->join('transaction' , 'transaction_menu.transaction_id=transaction.id')
        ->join('menu' , 'transaction_menu.menu_id = menu.id')
        ->whereIn('transaction.status' , $status)
        ->where('transaction.user_id' , $user_id);
        if($date){
            return $this->builder()
            ->select('transaction.id as transaction_id , transaction_menu.id transaction_menu_id , count , transaction_menu.menu_id as menu_id , transaction_menu.price as transaction_menu_price , photo , menu.name as name')
            ->where('transaction.updated_at BETWEEN "'. $date['start-date'].' 23:59:59'. '" and "'. $date['end-date'].' 23:59:59'.'"')
            ->get()
            ->getResultArray();
        }
        return $this->builder()
        ->select('transaction.id as transaction_id , transaction_menu.id transaction_menu_id , count , transaction_menu.menu_id as menu_id , transaction_menu.price as transaction_menu_price , photo , menu.name as name')
        ->get()
        ->getResultArray();
    }

    public function getMenuOrderList($canteen_id , $status , $length , $index)
    {
        return $this->builder()
        ->join('transaction' , 'transaction_menu.transaction_id=transaction.id')
        ->join('menu' , 'transaction_menu.menu_id = menu.id')
        ->whereIn('transaction.status' , $status)
        ->where('transaction.canteen_id' , $canteen_id)
        ->limit($length,$index)
        ->select('transaction.id as transaction_id , transaction_menu.id transaction_menu_id , count , transaction_menu.menu_id as menu_id , transaction_menu.price as transaction_menu_price , photo , menu.name as name, menu.status as status')
        ->get()
        ->getResultArray();
    }

    public function deleteMenuCart($transaction_id)
    {
        return $this->builder()
        ->where('transaction_id' , $transaction_id)
        ->delete();
    }

}