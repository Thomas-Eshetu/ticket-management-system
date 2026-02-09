<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
  public function dashboard(){
    return view("admin_pages.dashboard");
  }

  public function addUserView(){
    return view("admin_pages.addUser");
  }

  public function viewUserView(){
    return view("admin_pages.viewUser");
  }
}
