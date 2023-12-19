<?php

namespace App\Controllers;

class Register extends BaseController
{
    public function index(): string
    {
        if ($this->session->get('user')) {
            return redirect()->to('/');
        }

        $data = [
            'title' => 'Register | Dealer.in',
            'validation' => \Config\Services::validation()
        ];

        return view('register', $data);
    }

    public function auth()
    {
        if ($this->session->get('user')) {
            return redirect()->to('/');
        }

        if (!$this->validate([
            'nama' => 'required',
            'email' => 'required|valid_email|is_unique[user.email]',
            'password' => 'required|min_length[8]|matches[password2]',
            'password2' => 'required|matches[password]'
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $nama = $this->request->getVar('nama');
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $userModel = new \App\Models\UserModel();
        $userModel->createUser($nama, $email, $password);

        return redirect()->to('/login')->with('success', 'Account created successfully');
    }
}