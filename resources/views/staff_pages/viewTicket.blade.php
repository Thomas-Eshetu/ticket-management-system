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
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <title>Staff - View Ticket</title>
</head>

<body>
    @include('components.staffNavbar')

    <div class="staffContainer">
        @include('components.staffSidebar')

        <div class="main">
            <h4 class="text-muted">View Tickets</h4>
            <hr>

            <div class="viewContainer">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="ticketsTable">
                        <thead>
                            <th>#</th>
                            <th>Ticket No.</th>
                            <th>Affected Dep't</th>
                            <th>Issue Type</th>
                            <th>Issue Started At</th>
                            <th>Status</th>
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
                                    <td>{{ $ticket->department }}</td>
                                    <td>{{ $ticket->issue_type }}</td>
                                    <td>{{ $ticket->issue_start_date }}</td>
                                    <td>
                                        @if ($ticket->status === 'open')
                                            <span class="badge bg-primary">{{ $ticket->status }}</span>
                                        @elseif ($ticket->status === 'pending')
                                            <span class="badge bg-warning">{{ $ticket->status }}</span>
                                        @elseif ($ticket->status === 'resolved')
                                            <span class="badge bg-success">{{ $ticket->status }}</span>
                                        @else
                                            <span class="badge bg-secondary">Unidentified</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($ticket->assigned_technician == null)
                                            <span>TBA</span>
                                        @else
                                            <span class="badge" style="background: #FFA129">
                                                {{ $ticket->assigned_technician }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="" class="badge bg-primary text-white" title="View Ticket"
                                            data-bs-toggle="modal" data-bs-target="#staffViewTicketModal"
                                            data-id="{{ $ticket->id }}"
                                            data-ticket-number="{{ $ticket->ticket_number }}"
                                            data-requester="{{ $ticket->requester_name }}"
                                            data-department="{{ $ticket->department }}"
                                            data-issue-type="{{ $ticket->issue_type }}"
                                            data-issue-start="{{ $ticket->issue_start_date }}"
                                            data-affected-users="{{ $ticket->no_of_impacted_users }}"
                                            data-subject="{{ $ticket->subject }}"
                                            data-issue_description="{{ $ticket->issue_description }}"
                                            data-status="{{ $ticket->status }}"><i class="fas fa-eye"></i></a>
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

    @include('modals.staffViewTicketModal')


    <script>
        $(document).ready(function() {
            $('#ticketsTable').DataTable({
                pageLength: 10,
                lengthMenu: [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ],
                ordering: true,
                searching: true,
                dom: '<"row mb-3"<"col-md-6"l><"col-md-6 text-end"f>>rt<"row mt-3"<"col-md-6"i><"col-md-6 text-end"p>>'
            });
        });
    </script>

    <!----Script to populate the modal--->
    <script>
        document.getElementById('staffViewTicketModal').addEventListener('show.bs.modal', function(event) {
            const btn = event.relatedTarget;
            const status = btn.getAttribute('data-status');

            document.getElementById('modal-ticket-number').textContent = btn.getAttribute('data-ticket-number');
            document.getElementById('modal-requester').textContent = btn.getAttribute('data-requester');
            document.getElementById('modal-department').textContent = btn.getAttribute('data-department');
            document.getElementById('modal-issue-type').textContent = btn.getAttribute('data-issue-type');
            document.getElementById('modal-issue-start').textContent = btn.getAttribute('data-issue-start');
            document.getElementById('modal-affected-users').textContent = btn.getAttribute('data-affected-users');
            document.getElementById('modal-subject').textContent = btn.getAttribute('data-subject');
            document.getElementById('modal-description').textContent = btn.getAttribute('data-issue_description');
            document.getElementById('modal-status').textContent = status;
        });
    </script>




    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
</body>

</html>
