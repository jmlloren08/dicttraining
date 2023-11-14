<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\Response;

class OfficeController extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        return view('offices');
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $office = new \App\Models\Office();
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


        $office = new \App\Models\Office();
        $totalRecords = $office->select('id')->countAllResults();

        $totalRecordswithFilter = $office->select('id')
            ->orLike('office_name', $searchValue)
            ->orLike('office_code', $searchValue)
            ->orLike('office_description', $searchValue)
            ->orderBy($sortcolumn, $sortdir)
            ->countAllResults();

        $records = $office->select('*')
            ->orLike('office_name', $searchValue)
            ->orLike('office_code', $searchValue)
            ->orLike('office_description', $searchValue)
            ->orderBy($sortcolumn, $sortdir)
            ->findAll($rowperpage, $start);

        $data = array();
        foreach ($records as $record) {
            $data[] = array(
                "id"                    => $record['id'],
                "office_name"           => $record['office_name'],
                "office_code"           => $record['office_code'],
                "office_description"    => $record['office_description'],
                "created_at"            => $record['created_at'],
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

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {

        $office = new \App\Models\Office();
        $data = $this->request->getJSON();

        if (!$office->validate($data)) {
            $response = array(
                'status' => 'error',
                'error' => true,
                'messages' => $office->errors()
            );

            return $this->response->setStatusCode(Response::HTTP_BAD_REQUEST)->setJSON($response);
        }

        try {
            $office->insert($data);
            $response = array(
                'status' => 'success',
                'error' => false,
                'messages' => 'Author added successfully'
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

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $office = new \App\Models\Office();
        $data = $this->request->getJSON();
        unset($data->id);

        if (!$office->validate($data)) {
            $response = array(
                'status' => 'error',
                'error' => true,
                'messages' => $office->errors()
            );
            return $this->response->setStatusCode(Response::HTTP_BAD_REQUEST)->setJSON($response);
        }

        $office->update($id, $data);

        $response = array(
            'status' => 'success',
            'error' => false,
            'messages' => 'Author updated successfully'
        );

        return $this->response->setStatusCode(Response::HTTP_OK)->setJSON($response);
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {

        $office = new \App\Models\Office();

        if ($office->delete($id)) {
            $response = array(
                'status' => 'success',
                'error' => false,
                'messages' => 'Author deleted successfully'
            );

            return $this->response->setStatusCode(Response::HTTP_OK)->setJSON($response);
        }

        $response = array(
            'status' => 'error',
            'error' => true,
            'messages' => 'Author not found'
        );

        return $this->response->setStatusCode(Response::HTTP_NOT_FOUND)->setJSON($response);
    }
}
