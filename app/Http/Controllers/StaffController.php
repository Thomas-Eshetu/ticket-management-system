<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


class StaffController extends Controller
{
    public function staffDashboard()
    {
        $openTickets = Ticket::where('status', 'open')->count();
        $pendingTickets = Ticket::where('status', 'pending')->count();
        $resolvedTickets = Ticket::where('status', 'resolved')->count();

        $dailyTickets = Ticket::select(Ticket::raw('DATE(created_at) as date'), Ticket::raw('COUNT(*) as total'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        $weeklyTickets = Ticket::select(Ticket::raw('YEARWEEK(created_at) as week'), Ticket::raw('COUNT(*) as total'))
            ->groupBy('week')
            ->orderBy('week')
            ->get();
        $monthlyTickets = Ticket::select(Ticket::raw('DATE_FORMAT(created_at,"%Y-%m") as month'), Ticket::raw('COUNT(*) as total'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $recentTickets = Ticket::latest()->take(6)->get();

        return view("staff_pages.dashboard", compact([
            "openTickets",
            "pendingTickets",
            "resolvedTickets",
            'dailyTickets',
            'weeklyTickets',
            'monthlyTickets',
            'recentTickets'
        ]));
    }

    public function createTicketView()
    {
        return view("staff_pages.createTicket");
    }

    public function viewTicketView()
    {
        $tickets = Ticket::join('users', 'tickets.user_id', '=', 'users.id')
            ->select('tickets.*', 'users.name as requester_name')
            ->where('tickets.user_id', Auth::id())->latest()
            ->get();

        return view("staff_pages.viewTicket", compact("tickets"));
    }

    public function createTicket(Request $request)
    {
        $request->validate([
            'subject' => 'required|string',
            'department' => 'required|string',
            'issueType' => 'required',
            'issueDT' => 'required',
            'impactedUsers' => 'required',
            'issueDescription' => 'required|string',
        ]);

        // Get last ticket ID
        $lastTicket = Ticket::latest('id')->first();

        $nextId = $lastTicket ? $lastTicket->id + 1 : 1;

        // Generate formatted ticket number
        $ticketNumber = 'TCK-' . str_pad($nextId, 5, '0', STR_PAD_LEFT);

        $query = Ticket::create([
            'user_id' => Auth::id(),
            'ticket_number' => $ticketNumber,
            'department' => $request->department,
            'subject' => $request->subject,
            'issue_type' => $request->issueType,
            'issue_start_date' => $request->issueDT,
            'no_of_impacted_users' => $request->impactedUsers,
            'issue_description' => $request->issueDescription,
            'status' => "open",
        ]);

        if ($query) {
            return redirect()->back()->with('success', 'Ticket created successfully, IT technicians will contact you soon.');
        } else {
            return redirect()->back()->with('error', 'Unable to create a ticket, please try again.');
        }
    }

    public function profileView()
    {
        $staff = User::where('id', Auth::id())->first();
        return view("staff_pages.profile", compact("staff"));
    }

    public function updateProfile(Request $request)
    {
        $userID = Auth::id();

        $request->validate([
            'name'  => 'required|string|max:255',
            'gender'     => 'required|string',

            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($userID),
            ],

            'phone' => [
                'required',
                'string',
                'max:14',
                Rule::unique('users', 'phone')->ignore($userID),
            ],

            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'username')->ignore($userID),
            ],
        ]);

        $user = User::find($userID);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found!');
        }

        $user->update([
            'name'       => $request->name,
            'gender'     => $request->gender,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'username'   => $request->username,
        ]);


        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function changePassword(Request $request)
    {
        $request->validate(
            [
                'oldPass' => 'required',
                'newPass' => 'required|min:6',
                'retypePass' => 'required|same:newPass'
            ],
            [
                'oldPass.required' => 'Please enter your old password.',
                'newPass.required' => 'Please enter a new password.',
                'newPass.min' => 'New password must be at least 6 characters.',
                'retypePass.required' => 'Please retype the new password.',
                'retypePass.same' => 'The new passwords do not match.'
            ]
        );

        $user = User::find(Auth::id());

        if (!Hash::check($request->oldPass, $user->password)) {
            return back()->with('error', 'Old password is incorrect.');
        }

        $user->update([
            'password' => Hash::make($request->newPass)
        ]);

        return back()->with('success', 'Password changed successfully.');
    }
}
