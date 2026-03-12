<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin - View Tickets</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="/css/adminStyle.css" rel="stylesheet" />
    <link href="/css/style.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <style>
        /* ACTIVE (Primary) */
        .nav-pills .nav-link.tab-active.active {
            background-color: #0d6efd;
            color: #fff;
        }

        /* PENDING (Warning) */
        .nav-pills .nav-link.tab-pending.active {
            background-color: #ffc107;
            color: #fff;
        }

        /* DELAYED (Danger) */
        .nav-pills .nav-link.tab-delayed.active {
            background-color: #dc3545;
            color: #fff;
        }

        /* RESOLVED (Success) */
        .nav-pills .nav-link.tab-resolved.active {
            background-color: #198754;
            color: #fff;
        }

        .nav-pills .nav-link {
            transition: all 0.3s ease;
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <!--Import Navbar-->
    @include('components.adminNavbar')
    <div id="layoutSidenav">
        <!---Import Sidebar-->
        @include('components.adminSidebar')

        @php
            $status = request('status', 'active');
        @endphp
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h3 class="mt-4">Ticket Management</h3>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">View Tickets</li>
                    </ol>
                    <div class="viewTicketContainer">

                        <ul class="nav nav-tabs nav-pills flex-column flex-sm-row" id="ticketTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button
                                    class="badge bg-primary nav-link {{ $status == 'active' ? 'active' : '' }} tab-active"
                                    data-bs-toggle="tab" data-bs-target="#active" type="button">
                                    Active
                                </button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button
                                    class="badge bg-warning ms-3 nav-link {{ $status == 'pending' ? 'active' : '' }} tab-pending"
                                    data-bs-toggle="tab" data-bs-target="#pending" type="button">
                                    Pending
                                </button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button
                                    class="badge bg-danger ms-3 nav-link tab-delayed {{ $status == 'delayed' ? 'active' : '' }}"
                                    data-bs-toggle="tab" data-bs-target="#delayed" type="button">
                                    Delayed
                                </button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button
                                    class="badge bg-success ms-3 mb-2 nav-link {{ $status == 'resolved' ? 'active' : '' }} tab-resolved"
                                    data-bs-toggle="tab" data-bs-target="#resolved" type="button">
                                    Resolved
                                </button>
                            </li>
                        </ul>


                        <div class="tab-content mt-3">

                            <div class="tab-pane fade {{ $status == 'active' ? 'show active' : '' }}" id="active">
                                <h5 class="btn btn-sm btn-primary"><i class="fa-solid fa-circle-dot"></i> Active Tickets
                                </h5>

                                <table class="table table-striped" id="activeTicketsTable">
                                    <thead>
                                        <th>Ticket No.</th>
                                        <th>Requester</th>
                                        <th>Affected Department</th>
                                        <th>Issue Type</th>
                                        <th>Affected Users Count</th>
                                        <th>Issue Started At</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($activeTickets as $activeTicket)
                                            <tr>
                                                <td>
                                                    <span
                                                        class="badge bg-secondary">{{ $activeTicket->ticket_number }}</span>
                                                </td>
                                                <td>{{ $activeTicket->requester_name }}</td>
                                                <td>{{ $activeTicket->department }}</td>
                                                <td>{{ $activeTicket->issue_type }}</td>
                                                <td>{{ $activeTicket->no_of_impacted_users }}</td>
                                                <td>{{ $activeTicket->issue_start_date }}</td>
                                                <td>
                                                    <span class="badge bg-primary">{{ $activeTicket->status }}</span>
                                                </td>
                                                <td>
                                                    {{-- <a href="" class="badge bg-primary text-white"
                                                        title="View Ticket" data-bs-toggle="modal" data-bs-target="#viewTicketModal"><i class="fas fa-eye"></i></a> --}}

                                                    <a href="" class="badge bg-primary text-white"
                                                        title="View Ticket" data-bs-toggle="modal"
                                                        data-bs-target="#viewTicketModal"
                                                        data-id="{{ $activeTicket->id }}"
                                                        data-ticket-number="{{ $activeTicket->ticket_number }}"
                                                        data-requester="{{ $activeTicket->requester_name }}"
                                                        data-department="{{ $activeTicket->department }}"
                                                        data-issue-type="{{ $activeTicket->issue_type }}"
                                                        data-issue-start="{{ $activeTicket->issue_start_date }}"
                                                        data-affected-users="{{ $activeTicket->no_of_impacted_users }}"
                                                        data-subject="{{ $activeTicket->subject }}"
                                                        data-issue_description="{{ $activeTicket->issue_description }}"
                                                        data-status="{{ $activeTicket->status }}"
                                                        data-priority="{{ $activeTicket->priority }}"
                                                        data-due-date="{{ $activeTicket->issue_due_date }}"
                                                        data-assigned-tech="{{ $activeTicket->assigned_technician }}"
                                                        data-resolved-at="{{ $activeTicket->issue_resolved_at }}"
                                                        data-remark="{{ $activeTicket->remark }}"><i
                                                            class="fas fa-eye"></i></a>

                                                    <a href="{{ route('admin.editTicket', $activeTicket->id) }}"
                                                        class="badge bg-warning text-white" title="Edit Ticket"><i
                                                            class="fas fa-edit"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>

                            <div class="tab-pane fade {{ $status == 'pending' ? 'show active' : '' }}" id="pending">
                                <h5 class="btn btn-sm btn-warning text-light"><i
                                        class="fa-regular fa-hourglass-half"></i> Pending Tickets</h5>
                                <table class="table table-striped" id="pendingTicketsTable">
                                    <thead>
                                        <th>Ticket No.</th>
                                        <th>Affected Department</th>
                                        <th>Issue Type</th>
                                        <th>Affected Users Count</th>
                                        <th>Issue Started At</th>
                                        <th>Assigned Tech</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($pendingTickets as $pendingTicket)
                                            @if ($pendingTicket)
                                                <tr>
                                                    <td>
                                                        <span
                                                            class="badge bg-secondary">{{ $pendingTicket->ticket_number }}</span>
                                                    </td>
                                                    <td>{{ $pendingTicket->department }}</td>
                                                    <td>{{ $pendingTicket->issue_type }}</td>
                                                    <td>{{ $pendingTicket->no_of_impacted_users }}</td>
                                                    <td>{{ $pendingTicket->issue_start_date }}</td>
                                                    <td>{{ $pendingTicket->assigned_technician }}</td>
                                                    <td>
                                                        <span
                                                            class="badge bg-warning">{{ $pendingTicket->status }}</span>
                                                    </td>
                                                    <td>
                                                        <a href="" class="badge bg-primary text-white"
                                                            title="View Ticket" data-bs-toggle="modal"
                                                            data-bs-target="#viewTicketModal"
                                                            data-id="{{ $pendingTicket->id }}"
                                                            data-ticket-number="{{ $pendingTicket->ticket_number }}"
                                                            data-requester="{{ $pendingTicket->requester_name }}"
                                                            data-department="{{ $pendingTicket->department }}"
                                                            data-issue-type="{{ $pendingTicket->issue_type }}"
                                                            data-issue-start="{{ $pendingTicket->issue_start_date }}"
                                                            data-affected-users="{{ $pendingTicket->no_of_impacted_users }}"
                                                            data-subject="{{ $pendingTicket->subject }}"
                                                            data-issue_description="{{ $pendingTicket->issue_description }}"
                                                            data-status="{{ $pendingTicket->status }}"
                                                            data-priority="{{ $pendingTicket->priority }}"
                                                            data-due-date="{{ $pendingTicket->issue_due_date }}"
                                                            data-assigned-tech="{{ $pendingTicket->assigned_technician }}"
                                                            data-resolved-at="{{ $pendingTicket->issue_resolved_at }}"
                                                            data-remark="{{ $pendingTicket->remark }}"><i
                                                                class="fas fa-eye"></i></a>

                                                        <a href="{{ route('admin.editTicket', $pendingTicket->id) }}"
                                                            class="badge bg-warning text-white" title="Edit Ticket"><i
                                                                class="fas fa-edit"></i></a>
                                                    </td>
                                                </tr>
                                            @else
                                                {{-- <tr>
                                                    <td>No pending tickets available</td>
                                                </tr> --}}
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane fade {{ $status == 'delayed' ? 'show active' : '' }}"
                                id="delayed">
                                <h5 class="btn btn-sm btn-danger"><i class="fa-solid fa-clock"></i> Delayed Tickets
                                </h5>
                                <table class="table table-striped" id="delayedTicketsTable">
                                    <thead>
                                        <th>Ticket No.</th>
                                        <th>Affected Department</th>
                                        <th>Issue Type</th>
                                        <th>Affected Users Count</th>
                                        <th>Issue Started At</th>
                                        <th>Assigned Tech</th>
                                        <th>Issue Due Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @if ($delayedTickets->isNotEmpty())
                                            @foreach ($delayedTickets as $delayedTicket)
                                                <tr>
                                                    <td>
                                                        <span
                                                            class="badge bg-secondary">{{ $delayedTicket->ticket_number }}</span>
                                                    </td>
                                                    <td>{{ $delayedTicket->department }}</td>
                                                    <td>{{ $delayedTicket->issue_type }}</td>
                                                    <td>{{ $delayedTicket->no_of_impacted_users }}</td>
                                                    <td>{{ $delayedTicket->issue_start_date }}</td>
                                                    <td>{{ $delayedTicket->assigned_technician }}</td>
                                                    <td>
                                                        <span
                                                            class="badge bg-danger">{{ $delayedTicket->issue_due_date }}</span>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="badge bg-warning">{{ $delayedTicket->status }}</span>
                                                    </td>
                                                    <td>
                                                        <a href="" class="badge bg-primary text-white"
                                                            title="View Ticket" data-bs-toggle="modal"
                                                            data-bs-target="#viewTicketModal"
                                                            data-id="{{ $delayedTicket->id }}"
                                                            data-ticket-number="{{ $delayedTicket->ticket_number }}"
                                                            data-requester="{{ $delayedTicket->requester_name }}"
                                                            data-department="{{ $delayedTicket->department }}"
                                                            data-issue-type="{{ $delayedTicket->issue_type }}"
                                                            data-issue-start="{{ $delayedTicket->issue_start_date }}"
                                                            data-affected-users="{{ $delayedTicket->no_of_impacted_users }}"
                                                            data-subject="{{ $delayedTicket->subject }}"
                                                            data-issue_description="{{ $delayedTicket->issue_description }}"
                                                            data-status="{{ $delayedTicket->status }}"
                                                            data-priority="{{ $delayedTicket->priority }}"
                                                            data-due-date="{{ $delayedTicket->issue_due_date }}"
                                                            data-assigned-tech="{{ $delayedTicket->assigned_technician }}"
                                                            data-resolved-at="{{ $delayedTicket->issue_resolved_at }}"
                                                            data-remark="{{ $delayedTicket->remark }}"><i
                                                                class="fas fa-eye"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            {{-- <tr>
                                                <td colspan="8">No delayed tickets available</td>
                                            </tr> --}}
                                        @endif

                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane fade {{ $status == 'resolved' ? 'show active' : '' }}"
                                id="resolved">
                                <h5 class="btn btn-sm btn-success"><i class="fa-solid fa-circle-check"></i> Resolved
                                    Tickets</h5>
                                <table class="table table-striped" id="resolvedTicketsTable">
                                    <thead>
                                        <th>Ticket No.</th>
                                        <th>Affected Department</th>
                                        <th>Issue Type</th>
                                        <th>Affected Users Count</th>
                                        <th>Issue Started At</th>
                                        <th>Assigned Tech</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        @if ($resolvedTickets->isNotEmpty())
                                            @foreach ($resolvedTickets as $resolvedTicket)
                                                <tr>
                                                    <td>
                                                        <span
                                                            class="badge bg-secondary">{{ $resolvedTicket->ticket_number }}</span>
                                                    </td>
                                                    <td>{{ $resolvedTicket->department }}</td>
                                                    <td>{{ $resolvedTicket->issue_type }}</td>
                                                    <td>{{ $resolvedTicket->no_of_impacted_users }}</td>
                                                    <td>{{ $resolvedTicket->issue_start_date }}</td>
                                                    <td>{{ $resolvedTicket->assigned_technician }}</td>
                                                    <td>
                                                        <span
                                                            class="badge bg-success">{{ $resolvedTicket->status }}</span>
                                                    </td>
                                                    <td>
                                                        <a href="" class="badge bg-primary text-white"
                                                            title="View Ticket" data-bs-toggle="modal"
                                                            data-bs-target="#viewTicketModal"
                                                            data-id="{{ $resolvedTicket->id }}"
                                                            data-ticket-number="{{ $resolvedTicket->ticket_number }}"
                                                            data-requester="{{ $resolvedTicket->requester_name }}"
                                                            data-department="{{ $resolvedTicket->department }}"
                                                            data-issue-type="{{ $resolvedTicket->issue_type }}"
                                                            data-issue-start="{{ $resolvedTicket->issue_start_date }}"
                                                            data-affected-users="{{ $resolvedTicket->no_of_impacted_users }}"
                                                            data-subject="{{ $resolvedTicket->subject }}"
                                                            data-issue_description="{{ $resolvedTicket->issue_description }}"
                                                            data-status="{{ $resolvedTicket->status }}"
                                                            data-priority="{{ $resolvedTicket->priority }}"
                                                            data-due-date="{{ $resolvedTicket->issue_due_date }}"
                                                            data-assigned-tech="{{ $resolvedTicket->assigned_technician }}"
                                                            data-resolved-at="{{ $resolvedTicket->issue_resolved_at }}"
                                                            data-remark="{{ $resolvedTicket->remark }}"><i
                                                                class="fas fa-eye"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            
                                        @endif

                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>

                </div>
            </main>

            @include('components.adminFooter')
        </div>
    </div>

    <!--Import Modal-->
    @include('modals.viewTicketModal')


    <script>
        $(document).ready(function() {
            $('#activeTicketsTable, #pendingTicketsTable, #delayedTicketsTable, #resolvedTicketsTable').DataTable({
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
        document.getElementById('viewTicketModal').addEventListener('show.bs.modal', function(event) {
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
            document.getElementById('modal-priority').textContent = btn.getAttribute('data-priority');
            document.getElementById('modal-due-date').textContent = btn.getAttribute('data-due-date');
            document.getElementById('modal-assigned-tech').textContent = btn.getAttribute('data-assigned-tech');
            document.getElementById('modal-resolved-at').textContent = btn.getAttribute('data-resolved-at');
            document.getElementById('modal-remark').textContent = btn.getAttribute('data-remark');

            // ✅ Show or hide third table based on status
            const thirdTable = document.getElementById('modal-third-table');
            if (status.toLowerCase() === 'open') {
                thirdTable.style.display = 'none';
            } else {
                thirdTable.style.display = 'block';
            }
        });
    </script>

    @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    confirmButtonColor: '#28a745',
                    timer: 4000,
                    showConfirmButton: false,
                });
            });
        </script>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="charts/chart-area-demo.js"></script>
    <script src="charts/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>
