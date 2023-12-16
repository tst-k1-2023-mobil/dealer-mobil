<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        // dd($this->session->get('user')['nama']);
        return view('welcome_message');
    }
}
