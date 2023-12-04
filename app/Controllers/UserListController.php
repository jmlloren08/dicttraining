<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Response;
use CodeIgniter\RESTful\ResourceController;

class UserListController extends ResourceController
{
    public function index()
    {
        // if (isset($_SESSION['user']))
        // {
        //     return redirect()->to(base_url('login'));
        // }

        return view('users');
    }

    public function show($id = null)
    {
        $user = new \App\Models\User();
        $data = $user->find($id);
        return $this->response->setStatusCode(Response::HTTP_OK)->setJSON($data);
    }

    public function list()
    {
        $postData = $this->request->getPost();

        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $searchValue = $postData['search']['value'];
        $sortby = $postData['order'][0]['column']; // Column index
        $sortdir = $postData['order'][0]['dir']; // asc or desc
        $sortcolumn = $postData['columns'][$sortby]['data']; // Column name 


        $user = new \App\Models\User();
        $totalRecords = $user->select('id')->countAllResults();

        $totalRecordswithFilter = $user->select('id')
            ->orLike('firstname', $searchValue)
            ->orLike('lastname', $searchValue)
            ->orLike('username', $searchValue)
            ->orLike('email', $searchValue)
            ->orLike('role', $searchValue)
            ->orLike('status', $searchValue)
            ->orderBy($sortcolumn, $sortdir)
            ->countAllResults();

        $records = $user->select('*, CONCAT(firstname, " ", lastname) AS fullname')
            ->orLike('firstname', $searchValue)
            ->orLike('lastname', $searchValue)
            ->orLike('username', $searchValue)
            ->orLike('email', $searchValue)
            ->orLike('role', $searchValue)
            ->orLike('status', $searchValue)
            ->orderBy($sortcolumn, $sortdir)
            ->findAll($rowperpage, $start);

        $data = array();
        foreach ($records as $record) {
            $data[] = array(
                "id"        => $record['id'],
                "fullname"  => $record['fullname'],
                "username"  => $record['username'],
                "email"     => $record['email'],
                "role"      => $record['role'],
                "status"    => $record['status'],
            );
        }

        $response = array(
            "draw" => intval($draw),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecordswithFilter,
            "data" => $data
        );

        return $this->response->setStatusCode(Response::HTTP_OK)->setJSON($response);
    }

    public function create()
    {

        $user = new \App\Models\User();
        $data = $this->request->getJSON();

        if (!$user->validate($data)) {
            $response = array(
                'status' => 'error',
                'error' => true,
                'messages' => $user->errors()
            );

            return $this->response->setStatusCode(Response::HTTP_BAD_REQUEST)->setJSON($response);
        }

        try {
            $user->insert($data);
            $response = array(
                'status' => 'success',
                'error' => false,
                'messages' => 'User added successfully'
            );

            return $this->response->setStatusCode(Response::HTTP_CREATED)->setJSON($response);
        } catch (\Exception $e) {
            $reponse = array(
                'status'    => 'error',
                'error'     => true,
                'messages'  => $e->getMessage()
            );

            return $this->response->setStatusCode(Response::HTTP_BAD_REQUEST)->setJSON($reponse);
        }
    }

    public function update($id = null)
    {
        $user = new \App\Models\User();
        $data = $this->request->getJSON();
        unset($data->id);

        if (session('user')['role'] === 'User') {

            $allowedFields = ['firstname', 'lastname', 'username', 'email', 'password'];
            $allowedData = array_intersect_key((array) $data, array_flip($allowedFields));

            if (!$user->validate($allowedData)) {
                $response = array(
                    'status' => 'error',
                    'error' => true,
                    'messages' => $user->errors()
                );

                return $this->response->setStatusCode(Response::HTTP_BAD_REQUEST)->setJSON($response);
            }

            $user->update($id, $allowedData);

        } else {

            $allowedFields = ['role', 'status'];
            $allowedData = array_intersect_key((array) $data, array_flip($allowedFields));

            if (!$user->validate($allowedData)) {
                $response = [
                    'status' => 'error',
                    'error' => true,
                    'messages' => $user->errors()
                ];

                return $this->response->setStatusCode(Response::HTTP_BAD_REQUEST)->setJSON($response);
            }

            $user->update($id, $allowedData);
        }

        $response = [
            'status' => 'success',
            'error' => false,
            'messages' => 'User updated successfully'
        ];

        return $this->response->setStatusCode(Response::HTTP_OK)->setJSON($response);
    }

    public function delete($id = null)
    {

        $user = new \App\Models\User();

        if ($user->delete($id)) {
            $response = array(
                'status' => 'success',
                'error' => false,
                'messages' => 'User deleted successfully'
            );

            return $this->response->setStatusCode(Response::HTTP_OK)->setJSON($response);
        }

        $response = array(
            'status' => 'error',
            'error' => true,
            'messages' => 'User not found'
        );

        return $this->response->setStatusCode(Response::HTTP_NOT_FOUND)->setJSON($response);
    }
}
