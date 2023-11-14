<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\Response;

class CategoryController extends ResourceController
{
    public function index()
    {
        return view('categories');
    }

    public function show($id = null)
    {
        $category = new \App\Models\Category();
        $data = $category->find($id);
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


        $category = new \App\Models\Category();
        $totalRecords = $category->select('id')->countAllResults();

        $totalRecordswithFilter = $category->select('id')
            ->orLike('cat_severity', $searchValue)
            ->orLike('cat_status', $searchValue)
            ->orderBy($sortcolumn, $sortdir)
            ->countAllResults();

        $records = $category->select('*')
            ->orLike('cat_severity', $searchValue)
            ->orLike('cat_status', $searchValue)
            ->orderBy($sortcolumn, $sortdir)
            ->findAll($rowperpage, $start);

        $data = array();
        foreach ($records as $record) {
            $data[] = array(
                "id"            => $record['id'],
                "cat_severity"  => $record['cat_severity'],
                "cat_status"    => $record['cat_status'],
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

    public function create()
    {

        $category = new \App\Models\Category();
        $data = $this->request->getJSON();

        if (!$category->validate($data)) {
            $response = array(
                'status' => 'error',
                'error' => true,
                'messages' => $category->errors()
            );

            return $this->response->setStatusCode(Response::HTTP_BAD_REQUEST)->setJSON($response);
        }

        try {
            $category->insert($data);
            $response = array(
                'status' => 'success',
                'error' => false,
                'messages' => 'Category added successfully'
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
        $category = new \App\Models\Category();
        $data = $this->request->getJSON();
        unset($data->id);

        if (!$category->validate($data)) {
            $response = array(
                'status' => 'error',
                'error' => true,
                'messages' => $category->errors()
            );
            return $this->response->setStatusCode(Response::HTTP_BAD_REQUEST)->setJSON($response);
        }

        $category->update($id, $data);

        $response = array(
            'status' => 'success',
            'error' => false,
            'messages' => 'Category updated successfully'
        );

        return $this->response->setStatusCode(Response::HTTP_OK)->setJSON($response);
    }

    public function delete($id = null)
    {

        $category = new \App\Models\Category();

        if ($category->delete($id)) {
            $response = array(
                'status' => 'success',
                'error' => false,
                'messages' => 'Category deleted successfully'
            );

            return $this->response->setStatusCode(Response::HTTP_OK)->setJSON($response);
        }

        $response = array(
            'status' => 'error',
            'error' => true,
            'messages' => 'Category not found'
        );

        return $this->response->setStatusCode(Response::HTTP_NOT_FOUND)->setJSON($response);
    }

}
