<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;


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
      'status' => "active",
      'password' => Hash::make(12345678),
    ]);

    return redirect()->back()->with('success', 'Staff saved successfully!');
  }

  public function editUserView($id)
  {
    $user = User::find($id);

    return view("admin_pages.editUser", compact("user"));
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'staffName'  => 'required|string|max:255',
      'gender'     => 'required|string',

      'email' => [
        'required',
        'email',
        Rule::unique('users', 'email')->ignore($id),
      ],

      'phone' => [
        'required',
        'string',
        'max:14',
        Rule::unique('users', 'phone')->ignore($id),
      ],

      'userName' => [
        'required',
        'string',
        'max:255',
        Rule::unique('users', 'username')->ignore($id),
      ],

      'department' => 'required|string',
      'position'   => 'required|string',
      'role'       => 'required|string',
    ]);

    $user = User::find($id);

    if (!$user) {
      return redirect()->back()->with('error', 'User not found!');
    }

    $user->update([
      'name'       => $request->staffName,
      'gender'     => $request->gender,
      'email'      => $request->email,
      'phone'      => $request->phone,
      'department' => $request->department,
      'position'   => $request->position,
      'role'       => $request->role,
      'username'   => $request->userName,
    ]);


    return redirect()->back()->with('success', 'Staff updated successfully!');
  }
  public function resetPassword($id)
  {
    $user = User::findOrFail($id);

    $user->password = Hash::make('12345678');
    $user->save();

    return back()->with('success', 'Password reset to default (12345678)');
  }
  public function deactivateUser($id)
  {
    $user = User::findOrFail($id);

    $user->update([
      'status' => 'deactive'
    ]);
    return back()->with('success', 'User has been deactivated successfully!');
  }
  public function activateUser($id)
  {
    $user = User::findOrFail($id);

    $user->update([
      'status' => 'active'
    ]);
    return back()->with('success', 'User has been activated successfully!');
  }
}
