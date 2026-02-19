<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;

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
        $tickets = Ticket::where('user_id', Auth::id())->latest()->get();
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
}
