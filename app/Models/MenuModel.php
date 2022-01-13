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

    protected $allowedFields = ['user_id' , 'name' , 'type' ,'description'];

    protected $protectFields = false;

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getMenu($canteen_id=null , $keyword=null , $limit , $indeks)
    {
        $this->builder()->select('menu.id as id , menu.name as menu_name , menu.type as type_kode , menu_type.name as type_name , menu.price as price , menu.description as description, menu.photo as photo')
        ->join('users' , 'menu.user_id=users.id')
        ->join('menu_type','menu.type=menu_type.id')
        ->select('
            users.name as kantin_name , 
            users.id as kantin_id , 
            menu.id as menu_id , 
            menu.name as menu_name , 
            menu.photo as photo , 
            menu_type.id as type_id , 
            menu_type.name as type_name , 
            menu.price as price , 
            menu.description as description
        ')
        ->limit($limit,$indeks);

        if($canteen_id){
            $this->builder()->where('user_id' , $canteen_id);
        }
        if($keyword){
            $this->builder()->like('menu.name',$keyword);
        }

        return $this->builder()->get()->getResultArray();
    }

    public function getPaginMenu($canteen_id=null , $keyword=null)
    {
        $this->builder()->select('menu.id as id , menu.name as menu_name , menu.type as type_kode , menu_type.name as type_name , menu.price as price , menu.description as description, menu.photo as photo')
        ->where('user_id' , $canteen_id)
        ->join('menu_type','menu.type=menu_type.id');

        if($canteen_id){
            $this->builder()->where('user_id' , $canteen_id);
        }
        if($keyword){
            $this->builder()->like('menu.name',$keyword);
        }

        return $this->builder()->countAllResults();
    }

    public function getMenuPembeli($canteen_id , $keyword=null , $limit , $indeks)
    {
        $this->builder()
        ->join('users' , 'menu.user_id=users.id')
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
        ->where('users.id' , $canteen_id)
        ->limit($limit , $indeks);


        if($keyword){
            // $this->builder()->like('users.name',$keyword);
            $this->builder()->like('menu.name',$keyword);
            // $this->builder()->like('menu_type.name',$keyword);
            // $this->builder()->like('menu.description',$keyword);
        }

        return $this->builder()->get()->getResultArray();
    }

    public function getPaginMenuPembeli($keyword=null , $canteen_id)
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
        ->where('users.id' , $canteen_id);
        if($keyword){
            $this->builder()->like('menu.name',$keyword);
        }

        return $this->builder()->countAllResults();
    }
    
}