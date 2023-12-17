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

        unset($user['password'], $user['loyalitasId'], $user['totalSpending']);
        return $user;
    }

    public function getUserById($id)
    {
        return  $this->where(['id' => $id])->first();
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

    public function getLoyalty($id)
    {
        return $this->select('loyalitasId')->where(['id' => $id])->first();
    }

    public function getSpendingUser($id)
    {
        return $this->select('totalSpending')->where(['id' => $id])->first();
    }
}
