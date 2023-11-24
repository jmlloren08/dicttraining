<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Response;
use CodeIgniter\RESTful\ResourceController;

class UserListController extends ResourceController
{
    public function index()
    {
        return view('users');
    }

    public function show($id = null)
    {
        $office = new \App\Models\User();
        $data = $office->find($id);
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

}
