<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    public function staffDashboard()
    {
        return view("staff_pages.dashboard");
    }

    public function createTicketView()
    {
        return view("staff_pages.createTicket");
    }

    public function viewTicketView()
    {
        return view("staff_pages.viewTicket");
    }
}
