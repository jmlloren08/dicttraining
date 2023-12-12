<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\Response;

class ProfileController extends BaseController
{
    public function index()
    {
        $id = session()->get('user')['id'];

        $profile = new \App\Models\User;
        $userData = $profile->find($id);

        $data['user'] = $userData;

        return view('profile', $data);
    }

    public function show($id = null)
    {
        $user = new \App\Models\User();
        $data = $user->find($id);
        return $this->response->setStatusCode(Response::HTTP_OK)->setJSON($data);
    }

    public function update($id = null)
    {
        $user = new \App\Models\User();
        $data = $this->request->getJSON();
        unset($data->id);

        $allowedFields = ['firstname', 'lastname', 'username', 'email', 'password'];
        $allowedData = array_intersect_key((array) $data, array_flip($allowedFields));
        $allowedData['password'] = password_hash($allowedData['password'], PASSWORD_BCRYPT);

        if (!$user->validate($allowedData)) {
            $response = array(
                'status' => 'error',
                'error' => true,
                'messages' => $user->errors()
            );

            return $this->response->setStatusCode(Response::HTTP_BAD_REQUEST)->setJSON($response);
        }

        $user->update($id, $allowedData);

        $response = [
            'status' => 'success',
            'error' => false,
            'messages' => 'User updated successfully'
        ];

        return $this->response->setStatusCode(Response::HTTP_OK)->setJSON($response);
    }
}
