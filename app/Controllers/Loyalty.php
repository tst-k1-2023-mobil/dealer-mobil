<?php

namespace App\Controllers;

class Loyalty extends BaseController
{
    public function index(): string
    {
        $spending = $this->session->get('user')['totalSpending'];
        $data = [
            'spending' => $spending
        ];
        return view('loyalty', $data);
    }
}
