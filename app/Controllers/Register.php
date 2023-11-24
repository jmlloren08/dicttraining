<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class Register extends BaseController
{
    public function index()
    {
        if (isset($_SESSION['user'])) {
            return redirect()->to(base_url('.'));
        }

        return view('register');
    }

    public function registerUser()
    {
        $user = new User();

        $firstname = $this->request->getPost('firstname');
        $lastname = $this->request->getPost('lastname');
        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $passwordconfirm = $this->request->getPost('passwordconfirm');

        if ($password === $passwordconfirm) {

            $password = password_hash($password, PASSWORD_BCRYPT);

            $data = [
                'firstname' => $firstname,
                'lastname'  => $lastname,
                'username'  => $username,
                'email'     => $email,
                'password'  => $password
                // 'role'      => 'Unidentified',
                // 'status'    => 0
            ];

            $result = $user->insert($data);

            if ($result) {

                //$err['error'] = "Failed registration. Please retry again.";
                $scs['success'] = 'Successfully registered. Please login.';
                //return view('register', $scs);
                return redirect()->to(base_url('login'))->with('success', $scs['success']);
            
            } else {

                $err['error'] = "Failed registration. Please retry again.";
                return view('register', $err);
            }
        } else {

            $err['error'] = "Passwords do not match. Please retype your password properly.";
            return view('register', $err);
        }
    }
}
