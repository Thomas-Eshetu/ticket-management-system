<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function staffDashboard() {
        return view("staff_pages.dashboard");
    }
}
