<?php

namespace App\Models;

use CodeIgniter\Model;

class Loyalitas extends Model
{
    protected $table = 'loyalitas';
    protected $allowedFields = ['id', 'nama', 'threshold', 'diskon'];

    public function getDiskon($id){
        $data = $this->where(['id'=> $id])->first();
        return $data['diskon'];
    }
}