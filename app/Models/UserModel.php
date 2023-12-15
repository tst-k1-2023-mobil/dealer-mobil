<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $allowedFields = ['nama', 'email', 'password', 'admin', 'loyalitasId', 'totalSpending'];

    public function getUser($email, $password)
    {
        $user = $this->where(['email' => $email])->first();
        if (!$user || !password_verify($password, $user['password'])) {
            return false;
        }
     
        unset($user['password'], $user['admin'], $user['totalSpending'], $user['id']);
        return $user;
    }

    public function createUser($nama, $email, $password)
    {
        $this->save([
            'nama' => $nama,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'admin' => 0,
            'loyalitasId' => 1,
            'totalSpending' => 0
        ]);
    }
}
