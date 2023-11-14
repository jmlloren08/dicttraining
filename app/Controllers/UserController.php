<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\Response;

class UserController extends ResourceController
{
    public function index()
    {
        return view('users');
    }
}
