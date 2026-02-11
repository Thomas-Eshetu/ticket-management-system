<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
  public function dashboard()
  {
    return view("admin_pages.dashboard");
  }

  public function addUserView()
  {
    return view("admin_pages.addUser");
  }

  public function viewUserView()
  {
    $users = User::all();

    return view("admin_pages.viewUser", compact("users"));
  }

  public function store(Request $request)
  {
    // Validate data
    $request->validate([
      'staffName'  => 'required|string|max:255',
      'gender'     => 'required|string',
      'email'      => 'required|email|unique:users,email',
      'phone'      => 'required|string|max:20|unique:users,phone',
      'department' => 'required|string',
      'position'   => 'required|string',
      'role'       => 'required|string',
      'userName'   => 'required|string|max:255|unique:users,userName',
    ]);

    // Save to database
    User::create([
      'name' => $request->staffName,
      'gender'     => $request->gender,
      'email'      => $request->email,
      'phone'      => $request->phone,
      'department' => $request->department,
      'position'   => $request->position,
      'role'       => $request->role,
      'username'   => $request->userName,
      'password' => Hash::make(12345678),
    ]);

    return redirect()->back()->with('success', 'Staff saved successfully!');
  }

  public function editUserView(){
    return view("admin_pages.editUser");
  }
}
