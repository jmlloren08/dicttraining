<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\Response;

class TicketController extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {

        $office = new \App\Models\Office();
        $category = new \App\Models\Category();

        $data['categories'] = $category->findAll();
        $data['offices'] = $office->findAll();

        return view('tickets', $data);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $ticket = new \App\Models\Ticket();
        $data = $ticket->find($id);
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

        $userRole = session('user')['role'];
        $loggedInUserID = session('user')['id'];

        $ticket = new \App\Models\Ticket();

        if ($userRole === 'Admin') {

            $totalRecords = $ticket->countAllResults();

            $totalRecordswithFilter = $ticket->select('id')
                ->join('users', 'users.id = tickets.user_id')
                ->join('offices', 'offices.id = tickets.office_id')
                ->orLike('offices.office_name', $searchValue)
                ->orLike('offices.office_code', $searchValue)
                ->orLike('offices.office_description', $searchValue)
                ->orLike('ticket_firstname', $searchValue)
                ->orLike('ticket_lastname', $searchValue)
                ->orLike('ticket_email', $searchValue)
                ->orLike('ticket_severity_id', $searchValue)
                ->orLike('ticket_description', $searchValue)
                ->orderBy($sortcolumn, $sortdir)
                ->countAllResults();

            $records = $ticket->select('tickets.*, CONCAT(offices.office_name, " " "(" , offices.office_code, ")") as office, categories.cat_severity as catseverity, catnewstatus.cat_status as catstatus')
                //->having('user_id', $loggedInUserID)
                ->join('users', 'users.id = user_id')
                ->join('offices', 'offices.id = tickets.office_id')
                ->join('categories', 'categories.id = tickets.ticket_severity_id', 'left')
                ->join('categories as catnewstatus', 'catnewstatus.id = tickets.ticket_status_id', 'left')
                ->orLike('offices.office_name', $searchValue)
                ->orLike('offices.office_code', $searchValue)
                ->orLike('categories.cat_severity', $searchValue)
                ->orLike('catnewstatus.cat_status', $searchValue)
                ->orLike('ticket_firstname', $searchValue)
                ->orLike('ticket_lastname', $searchValue)
                ->orLike('ticket_email', $searchValue)
                ->orLike('ticket_description', $searchValue)
                ->orderBy($sortcolumn, $sortdir)
                ->findAll($rowperpage, $start);
        } else {

            $totalRecords = $ticket->where('user_id', $loggedInUserID)
                ->countAllResults();

            $totalRecordswithFilter = $ticket->select('id')
                ->join('users', 'users.id = tickets.user_id')
                ->join('offices', 'offices.id = tickets.office_id')
                ->orLike('offices.office_name', $searchValue)
                ->orLike('offices.office_code', $searchValue)
                ->orLike('offices.office_description', $searchValue)
                ->orLike('ticket_firstname', $searchValue)
                ->orLike('ticket_lastname', $searchValue)
                ->orLike('ticket_email', $searchValue)
                ->orLike('ticket_severity_id', $searchValue)
                ->orLike('ticket_description', $searchValue)
                ->orderBy($sortcolumn, $sortdir)
                ->countAllResults();

            $records = $ticket->select('tickets.*, CONCAT(offices.office_name, " " "(" , offices.office_code, ")") as office, categories.cat_severity as catseverity, catnewstatus.cat_status as catstatus')
                ->having('user_id', $loggedInUserID)
                ->join('users', 'users.id = user_id')
                ->join('offices', 'offices.id = tickets.office_id')
                ->join('categories', 'categories.id = tickets.ticket_severity_id', 'left')
                ->join('categories as catnewstatus', 'catnewstatus.id = tickets.ticket_status_id', 'left')
                ->orLike('offices.office_name', $searchValue)
                ->orLike('offices.office_code', $searchValue)
                ->orLike('categories.cat_severity', $searchValue)
                ->orLike('catnewstatus.cat_status', $searchValue)
                ->orLike('ticket_firstname', $searchValue)
                ->orLike('ticket_lastname', $searchValue)
                ->orLike('ticket_email', $searchValue)
                ->orLike('ticket_description', $searchValue)
                ->orderBy($sortcolumn, $sortdir)
                ->findAll($rowperpage, $start);
        }

        $data = array();
        foreach ($records as $record) {
            $data[] = array(
                "id"                    => $record['id'],
                "user_id"               => $record['user_id'],
                "office"                => $record['office'],
                "catseverity"           => $record['catseverity'],
                "catstatus"             => $record['catstatus'],
                "ticket_firstname"      => $record['ticket_firstname'],
                "ticket_lastname"       => $record['ticket_lastname'],
                "ticket_email"          => $record['ticket_email'],
                "ticket_description"    => $record['ticket_description'],
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

        $ticket = new \App\Models\Ticket();
        $data = $this->request->getJSON();

        if (!$ticket->validate($data)) {
            $response = array(
                'status' => 'error',
                'error' => true,
                'messages' => $ticket->errors()
            );

            return $this->response->setStatusCode(Response::HTTP_BAD_REQUEST)->setJSON($response);
        }

        try {
            $ticket->insert($data);
            $response = array(
                'status' => 'success',
                'error' => false,
                'messages' => 'Post added successfully'
            );

            return $this->response->setStatusCode(Response::HTTP_CREATED)->setJSON($response);
        } catch (\Exception $e) {
            $response = array(
                'status' => 'error',
                'error' => true,
                'messages' => $e->getMessage()
            );

            return $this->response->setStatusCode(Response::HTTP_BAD_REQUEST)->setJSON($response);
        }
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $ticket = new \App\Models\Ticket();
        $data = $this->request->getJSON();
        unset($data->id);

        $allowedFields = ['ticket_description', 'ticket_status_id'];
        $allowedData = array_intersect_key((array) $data, array_flip($allowedFields));

        if (!$ticket->validate($allowedData)) {
            $response = array(
                'status' => 'error',
                'error' => true,
                'messages' => $ticket->errors()
            );

            return $this->response->setStatusCode(Response::HTTP_NOT_MODIFIED)->setJSON($response);
        }

        $ticket->update($id, $allowedData);
        $response = array(
            'status' => 'success',
            'error' => false,
            'messages' => 'Post updated successfully'
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
        $ticket = new \App\Models\Ticket();

        if ($ticket->delete($id)) {
            $response = array(
                'status' => 'success',
                'error' => false,
                'messages' => 'Post deleted successfully'
            );

            return $this->response->setStatusCode(Response::HTTP_OK)->setJSON($response);
        }

        $response = array(
            'status' => 'error',
            'error' => true,
            'messages' => 'Post not found'
        );

        return $this->response->setStatusCode(Response::HTTP_NOT_FOUND)->setJSON($response);
    }
}
