<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class Login extends BaseController
{
    public function index()
    {
        if (isset($_SESSION['user']))
        {
            return redirect()->to(base_url('dashboard'));
        }

        return view('login');
    }

    public function loginUser()
    {
        $user = new User();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $result = $user->where('email', $email)->first();
        //var_dump($result);

        if (!empty($result) && password_verify($password, $result['password'])) {

            $this->session->set('user', $result);
            ///$this->session->set('is')
            return redirect()->to(base_url(''));

        } else {
            $data['error'] = 'User not found. Please check your credentials.';
            //return redirect()->back();
        }

        return view('login', $data);
    }

    public function logout()
    {
        session_destroy();
        return redirect()->to(base_url('login'));
    }
}
