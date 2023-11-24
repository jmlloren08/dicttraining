<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        //session_start();
        // if (!isset($_SESSION['user']))
        // {
        //     return redirect()->to(base_url('login'));
        // }

        $ticket = new \App\Models\Ticket;

        $severityCounts = [
            1 => $ticket->where('ticket_severity_id', 1)->countAllResults(),
            2 => $ticket->where('ticket_severity_id', 2)->countAllResults(),
            3 => $ticket->where('ticket_severity_id', 3)->countAllResults(),
            4 => $ticket->where('ticket_severity_id', 4)->countAllResults(),
        ];

        $statusCounts = [
            1 => $ticket->where('ticket_status_id', 1)->countAllResults(),
            2 => $ticket->where('ticket_status_id', 2)->countAllResults(),
            3 => $ticket->where('ticket_status_id', 3)->countAllResults(),
            4 => $ticket->where('ticket_status_id', 4)->countAllResults(),
        ];

        $data['statusCounts'] = $statusCounts;
        $data['severityCounts'] = $severityCounts;

        return view('dashboard', $data);
    }
}
