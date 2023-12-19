<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index(): string
    {
        if ($this->session->get('user')) {
            return redirect()->to('/');
        }

        $data = [
            'title' => 'Login | Dealer.in',
            'validation' => \Config\Services::validation()
        ];
        return view('login', $data);
    }

    public function auth()
    {
        if ($this->session->get('user')) {
            return redirect()->to('/');
        }

        if (!$this->validate([
            'email' => 'required|valid_email',
            'password' => 'required'
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $userModel = new \App\Models\UserModel();
        $user = $userModel->getUser($email, $password);

        if ($user) {
            $this->session->set('user', $user);
            return redirect()->to('/');
        } else {
            return redirect()->to('/login')->withInput()->with('error', 'Email or password is incorrect');
        }
    }

    public function logout()
    {
        if (!$this->session->get('user')) {
            return redirect()->to('/login');
        }

        $this->session->remove('user');
        return redirect()->to('/login');
    }
}