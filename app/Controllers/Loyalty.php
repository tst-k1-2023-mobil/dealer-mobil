<?php

namespace App\Controllers;

use App\Models\UserModel;

class Loyalty extends BaseController
{
    public function index()
    {
        if (!$this->session->get('user')) {
            return redirect()->to('/login');
        }
        
        if ($this->session->get('user')['admin'] == 1) {
            return redirect()->to('/');
        }

        $usermodel = model(UserModel::class);
        $spending = $usermodel->getSpendingUser($this->session->get('user')['id']);
        
        $data = [
            'spending' => $spending['totalSpending'],
            'title' => 'Loyalty | Dealer.in'
        ];
        return view('loyalty', $data);
    }
}
