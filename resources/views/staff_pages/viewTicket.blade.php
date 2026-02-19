<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <title>Staff - View Ticket</title>
</head>

<body>
    @include('components.staffNavbar')

    <div class="staffContainer">
        @include('components.staffSidebar')

        <div class="main">
            <h4>View Tickets</h4>
            <hr>

            <div class="viewContainer">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <th>#</th>
                            <th>Ticket No.</th>
                            <th>Issue Type</th>
                            <th>Issue Started At</th>
                            <th>Status</th>
                            <th>Priority</th>
                            <th>Assigned Technician</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($tickets as $ticket)
                                <tr>
                                    <td>{{ $loop->iteration }} </td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $ticket->ticket_number }}</span>
                                    </td>
                                    <td>{{ $ticket->issue_type }}</td>
                                    <td>{{ $ticket->issue_start_date }}</td>
                                    <td>
                                        @if ($ticket->status === 'open')
                                            <span class="badge bg-primary">{{ $ticket->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($ticket->priority == null)
                                            <span>TBA</span>
                                        @else
                                            {{ $ticket->priority }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($ticket->assigned_technician == null)
                                            <span>TBA</span>
                                        @else
                                            {{ $ticket->assigned_technician }}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="" class="badge bg-primary text-white" title="View Ticket"><i
                                                class="fas fa-eye"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <hr>
    <span class="fs-8 text-center d-block">&copy; 2026, All rights reserved!</span>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
</body>

</html>
