<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ProfileController extends BaseController
{
    public function index()
    {
        $userID = session()->get('user')['id'];

        $profile = new \App\Models\User;
        $userData = $profile->find($userID);
        
        $data['user'] = $userData;

        return view('profile', $data);
    }

}
