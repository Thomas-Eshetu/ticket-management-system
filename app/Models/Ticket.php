<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';

    protected $fillable = [
        'user_id',
        'ticket_number',
        'department',
        'subject',
        'issue_type',
        'issue_start_date',
        'no_of_impacted_users',
        'issue_description',
        'status',
        'priority',
        'assigned_technician',
        'issue_resolved_at',
        'remark',
    ];
}
