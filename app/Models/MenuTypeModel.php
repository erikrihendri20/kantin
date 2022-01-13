<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuTypeModel extends Model
{
    protected $table      = 'menu_type';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['name'];

    protected $protectFields = false;

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    // public function getMenu($user_id,$type=null,$keyword=null)
    // {
    //     $this->builder()->select('menu.id as id , menu.name as menu_name , menu.type as type_kode , menu_type.name as type_name , menu.price as price , menu.description')
    //     ->where('user_id' , $user_id)
    //     ->join('menu_type','menu.type=menu_type.id');

    //     if($type){
    //         $this->builder()->where('menu.type' , $type);
    //     }
    //     if($keyword){
    //         $this->builder()->like('menu.name',$keyword);
    //     }

    //     return $this->builder()->get()->getResultArray();
    // }
}