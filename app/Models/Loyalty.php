<?php

namespace App\Models;

use CodeIgniter\Model;

class Loyalty extends Model
{
    protected $table = 'loyalitas';
    protected $allowedFields = ['nama', 'treshold', 'diskon'];

    public function getLoyalty($id)
    {
        return $this->where(['id' => $id])->first();
    }
}
