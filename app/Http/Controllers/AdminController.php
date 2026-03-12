<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
  public function dashboard()
  {

    $activeTickets = Ticket::where('status', 'open')
      ->count();
    $pendingTickets = Ticket::where('status', 'pending')
      ->count();
    $resolvedTickets = Ticket::where('status', 'resolved')
      ->count();
    $delayedTickets = Ticket::where('status', 'pending')
      ->where('issue_due_date', '<', now())
      ->count();

    $recentTickets = Ticket::latest()
      ->take(4)
      ->get();

   

$ticketTrend = Ticket::selectRaw('DAYNAME(created_at) as day,
        COUNT(*) as created_count,
        SUM(CASE WHEN status="resolved" THEN 1 ELSE 0 END) as resolved_count
    ')
    ->groupBy('day')
    ->get();

$daysOrder = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];

$trendData = [
    'created' => [],
    'resolved' => []
];

foreach ($daysOrder as $day) {

    $record = $ticketTrend->firstWhere('day', $day);

    $trendData['created'][] = $record->created_count ?? 0;
    $trendData['resolved'][] = $record->resolved_count ?? 0;

}


$monthlyTickets = Ticket::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
    ->whereYear('created_at', date('Y'))
    ->groupBy('month')
    ->orderBy('month')
    ->get();

$months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

$monthlyData = [];

foreach(range(1,12) as $m){
    $record = $monthlyTickets->firstWhere('month', $m);
    $monthlyData[] = $record->total ?? 0;
}

    return view("admin_pages.dashboard", compact(
      "activeTickets",
      "pendingTickets",
      "resolvedTickets",
      "delayedTickets",
      "recentTickets",
      "trendData",
      "monthlyData"
    ));
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

  //responsible to add staff users
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

  public function viewTickets()
  {
    $activeTickets = Ticket::join('users', 'tickets.user_id', '=', 'users.id')
      ->where('tickets.status', 'open')
      ->select('tickets.*', 'users.name as requester_name')
      ->get();

    $pendingTickets = Ticket::join('users', 'tickets.user_id', '=', 'users.id')
      ->where('tickets.status', 'pending')
      ->select('tickets.*', 'users.name as requester_name')
      ->get();

    $resolvedTickets = Ticket::join('users', 'tickets.user_id', '=', 'users.id')
      ->where('tickets.status', 'resolved')
      ->select('tickets.*', 'users.name as requester_name')
      ->get();

    $delayedTickets = Ticket::join('users', 'tickets.user_id', '=', 'users.id')
      ->where('tickets.status', 'pending')->where('issue_due_date', '<', now())
      ->select('tickets.*', 'users.name as requester_name')
      ->get();

    return view("admin_pages.viewTickets", compact(
      "activeTickets",
      "pendingTickets",
      "resolvedTickets",
      "delayedTickets",

    ));
  }

  public function editTicketView($id)
  {
    $ticket = Ticket::find($id);
    return view("admin_pages.editTicket", compact("ticket"));
  }

  public function updateTicket(Request $request, $id)
  {
    $ticket = Ticket::find($id);
    if (!$ticket) {
      return redirect()->back()->with('error', 'Ticket not found!');
    }

    $ticket->update([
      'status' => $request->status,
      'priority' => $request->priority,
      'issue_due_date' => $request->dueDate,
      'assigned_technician' => $request->assignedTech,
      'remark' => $request->remark,
      'issue_resolved_at' => $request->resolveDate,
    ]);

    return redirect()->to('admin-viewTicket')->with('success', 'Ticket updated successfully!');
  }
}
