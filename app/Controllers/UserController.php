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

        $user->select('users.id, auth_groups_users.group as usergroup, auth_identities.secret as secretemail, users.username as uname')
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id', 'left')
            ->join('auth_identities', 'auth_identities.user_id = users.id', 'left');

        $totalRecords = $user->select('id')->countAllResults();

        $totalRecordswithFilter = $user->select('id')
            ->orLike('usergroup', $searchValue)
            ->orLike('secretemail', $searchValue)
            ->orLike('uname', $searchValue)
            ->orderBy($sortcolumn, $sortdir)
            ->countAllResults();

        $records = $user->select('*')
            ->orLike('usergroup', $searchValue)
            ->orLike('secretemail', $searchValue)
            ->orLike('uname', $searchValue)
            ->orderBy($sortcolumn, $sortdir)
            ->findAll($rowperpage, $start);

        $data = array();
        foreach ($records as $record) {
            $data[] = array(
                "id"            => $record['id'],
                "usergroup"     => $record['usergroup'],
                "secretemail"   => $record['secretemail'],
                "uname"         => $record['uname'],
                "created_at"    => $record['created_at'],
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
