<?php

namespace App\Controllers;

class Loyalty extends BaseController
{
    public function index(): string
    {
        if (!$this->session->get('user')) {
            return redirect()->to('/login');
        }

        $spending = $this->session->get('user')['totalSpending'];
        $data = [
            'spending' => $spending
        ];
        return view('loyalty', $data);
    }
}
