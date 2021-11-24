<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table      = 'menu';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['user_id' , 'name' , 'type' , 'type' ,'description'];

    protected $protectFields = false;

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getMenu($user_id,$keyword=null , $limit , $indeks)
    {
        $this->builder()->select('menu.id as id , menu.name as menu_name , menu.type as type_kode , menu_type.name as type_name , menu.price as price , menu.description as description, menu.photo as photo')
        ->where('user_id' , $user_id)
        ->join('menu_type','menu.type=menu_type.id')
        ->limit($limit,$indeks);

        if($keyword){
            $this->builder()->like('menu.name',$keyword);
        }

        return $this->builder()->get()->getResultArray();
    }

    public function getPaginMenu($user_id , $keyword=null)
    {
        $this->builder()->select('menu.id as id , menu.name as menu_name , menu.type as type_kode , menu_type.name as type_name , menu.price as price , menu.description as description, menu.photo as photo')
        ->where('user_id' , $user_id)
        ->join('menu_type','menu.type=menu_type.id');

        if($keyword){
            $this->builder()->like('menu.name',$keyword);
        }

        return $this->builder()->countAllResults();
    }

    public function getMenuPembeli($keyword=null , $limit , $indeks)
    {
        $this->builder()->join('users' , 'menu.user_id=users.id')
        ->join('menu_type' , 'menu.type=menu_type.id')
        ->select('
        users.name as kantin_name , 
        users.id as kantin_id , 
        menu.id as menu_id , 
        menu.name as menu_name , 
        menu.photo as photo , 
        menu_type.id as type_id , 
        menu_type.name as type_name , 
        menu.price as price , 
        menu.description as description')
        ->limit($limit , $indeks);

        if($keyword){
            $this->builder()->like('users.name',$keyword)
            ->orLike('menu.name',$keyword)
            ->orLike('menu_type.name',$keyword)
            ->orLike('menu.description',$keyword);
        }

        return $this->builder()->get()->getResultArray();
    }

    public function getPaginMenuPembeli($keyword=null)
    {
        $this->builder()->join('users' , 'menu.user_id=users.id')
        ->join('menu_type' , 'menu.type=menu_type.id')
        ->select('
        users.name as kantin_name , 
        users.id as kantin_id , 
        menu.id as menu_id , 
        menu.name as menu_name , 
        menu.photo as photo , 
        menu_type.id as type_id , 
        menu_type.name as type_name , 
        menu.price as price , 
        menu.description as description');
        if($keyword){
            $this->builder()->like('users.name',$keyword)
            ->orLike('menu.name',$keyword)
            ->orLike('menu_type.name',$keyword)
            ->orLike('menu.description',$keyword);
        }

        return $this->builder()->countAllResults();
    }
    
}