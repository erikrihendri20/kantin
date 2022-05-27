<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table      = 'menu';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['user_id' , 'name' , 'type' ,'description , rating , count_purcased , time_estimate' , 'status' , 'photo'];

    protected $protectFields = false;

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getMenu($canteen_id=null , $keyword=null , $limit , $indeks,$status)
    {
        $this->builder()->select('menu.id as id , menu.name as menu_name , menu.type as type_kode , menu_type.name as type_name , menu.price as price , menu.description as description, menu.photo as photo, menu.status as status')
        ->join('users' , 'menu.user_id=users.id')
        ->join('menu_type','menu.type=menu_type.id')
        ->where('menu.deleted_at' , null)
        ->where('menu.status' , $status)
        ->select('
            users.name as kantin_name , 
            users.id as kantin_id , 
            menu.id as menu_id , 
            menu.name as menu_name , 
            menu.photo as photo , 
            menu_type.id as type_id , 
            menu_type.name as type_name , 
            menu.price as price , 
            menu.description as description,
            menu.rating as rating,
            menu.time_estimate as time_estimate
        ')
        ->limit($limit,$indeks)
        ->orderBy('menu.status' , 'DESC')
        ->orderBy('menu.rating' , 'DESC');

        if($canteen_id){
            $this->builder()->where('user_id' , $canteen_id);
        }
        if($keyword){
            $this->builder()->like('menu.name',$keyword);
        }

        return $this->builder()->get()->getResultArray();
    }

    public function getPaginMenu($canteen_id=null , $keyword=null , $status)
    {
        $this->builder()->select('menu.id as id , menu.name as menu_name , menu.type as type_kode , menu_type.name as type_name , menu.price as price , menu.description as description, menu.photo as photo, menu.status as status')
        ->where('user_id' , $canteen_id)
        ->where('menu.deleted_at' , null)
        ->where('menu.status' , $status)
        ->join('menu_type','menu.type=menu_type.id')
        ->orderBy('menu.status' , 'DESC')
        ->orderBy('menu.rating' , 'DESC');

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
        menu.description as description,
        menu.rating as rating,
        menu.status as status')
        ->where('users.id' , $canteen_id)
        ->where('menu.deleted_at' , null)
        ->limit($limit , $indeks)
        ->orderBy('menu.rating' , 'DESC');


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
        menu.description as description,
        menu.status as status')
        ->where('users.id' , $canteen_id)
        ->where('menu.deleted_at' , null)
        ->orderBy('menu.rating' , 'DESC');
        if($keyword){
            $this->builder()->like('menu.name',$keyword);
        }

        return $this->builder()->countAllResults();
    }
    
}