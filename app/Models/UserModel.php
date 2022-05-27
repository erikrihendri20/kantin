<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['name', 'email' , 'role' , 'photo' , 'password'];

    protected $protectFields = false;

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getStand($stand_id=null)
    {
        $this->builder()
        ->join('canteen_info' , 'users.id=canteen_info.user_id' , 'left')
        ->select('
        users.id as user_id,
        canteen_info.id as canteen_info_id,
        users.name as user_name,
        users.photo as photo,
        canteen_info.stand_picture as stand_picture,
        canteen_info.name as canteen_info_name,
        canteen_info.description as canteen_info_description,
        canteen_info.rating as canteen_info_rating,
        canteen_info.close_hours as close_hours, 
        canteen_info.open_hours as open_hours,
        canteen_info.count_buyer as count_buyer, 
        canteen_info.status as status' 
        )
        ->where('users.role' , 3);
        if($stand_id!=null){
            return $this->builder()
            ->where('users.id' , $stand_id)
            ->get()
            ->getRowArray();
        }
        return $this->builder()
        ->get()
        ->getResultArray();
    }
}