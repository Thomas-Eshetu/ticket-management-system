<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin - Edit Tickets</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="/css/adminStyle.css" rel="stylesheet" />
    <link href="/css/style.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="sb-nav-fixed">
    <!--Import Navbar-->
    @include('components.adminNavbar')
    <div id="layoutSidenav">
        <!---Import Sidebar-->
        @include('components.adminSidebar')
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h3 class="mt-4">Ticket Management</h3>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Edit Ticket</li>
                    </ol>
                    <div class="editTicketContainer">
                        <div class="titel">
                            <h4 class="text-center">Edit Ticket <i class="fa-solid fa-file-pen"></i></43>
                        </div>
                        <hr>
                        <form action="{{ route('ticket.update', $ticket->id) }}" method="post">
                            @csrf

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="" class="form-label mb-1">Ticket No.</label>
                                    <input type="text" class="form-control" value="{{ $ticket->ticket_number }}"
                                        readonly>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="" class="form-label mb-1">Requester</label>
                                    <input type="text" class="form-control" value="{{ $ticket->user_id }}" readonly>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="" class="form-label mb-1">Affected Dep't</label>
                                    <input type="text" class="form-control" value="{{ $ticket->department }}"
                                        readonly>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="" class="form-label mb-1">Subject</label>
                                    <input type="text" class="form-control" value="{{ $ticket->subject }}" readonly>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="" class="form-label mb-1">Issue Type</label>
                                    <input type="text" class="form-control" value="{{ $ticket->issue_type }}"
                                        readonly>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="" class="form-label mb-1">Issue Started Date</label>
                                    <input type="text" class="form-control" value="{{ $ticket->issue_start_date }}"
                                        readonly>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="" class="form-label mb-1">Affected Users Count</label>
                                    <input type="text" class="form-control"
                                        value="{{ $ticket->no_of_impacted_users }}" readonly>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="" class="form-label mb-1">Issue Description</label>
                                    <textarea name="" id="" class="form-control" readonly>{{ $ticket->issue_description }}</textarea>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="" class="form-label mb-1">Status <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <select class="form-select form-control" name="status" required>
                                            <option value="" disabled selected>Select</option>
                                            <option value="pending" {{ $ticket->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="resolved" {{ $ticket->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="" class="form-label mb-1">Priority <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <select class="form-select form-control" name="priority" required>
                                            <option value="" disabled selected>Select</option>
                                            <option value="high" {{ $ticket->priority == 'high' ? 'selected' : '' }}>High</option>
                                            <option value="medium" {{ $ticket->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                                            <option value="low" {{ $ticket->priority == 'low' ? 'selected' : '' }}>Low</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="" class="form-label mb-1">{{ $ticket->status == 'open' ? 'Assign Tech' : 'Assigned Tech'}} <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <select class="form-select form-control" name="assignedTech" required>
                                            <option value="" disabled selected>Select</option>
                                            <option value="Thomas" {{ $ticket->assigned_technician == 'Thomas' ? 'selected' : '' }}>Thomas</option>
                                            <option value="Mulugeta" {{ $ticket->assigned_technician == 'Mulugeta' ? 'selected' : '' }}>Mulugeta</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="" class="form-label mb-1">Issue Due Date <span
                                            class="text-danger">*</span></label>
                                    <input type="datetime-local" class="form-control" name="dueDate"
                                        value="{{ $ticket->issue_due_date }}" required>
                                </div>

                                @if ($ticket->status === 'pending')
                                    <div class="col-md-4 mb-3">
                                        <label for="" class="form-label mb-1">Issue Resolved At <span
                                                class="text-danger">*</span></label>
                                        <input type="datetime-local" class="form-control" name="resolveDate"
                                            required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="" class="form-label mb-1">Remark <span
                                                class="text-danger">*</span></label>
                                        <textarea name="remark" id="" class="form-control" required></textarea>
                                    </div>
                                @endif

                                <div class="text-end">
                                    <button type="submit" class="btn btn-success">
                                        Update <i class="fas fa-edit"></i>
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </main>

            @include('components.adminFooter')
        </div>
    </div>

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
    <script src="/js/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="charts/chart-area-demo.js"></script>
    <script src="charts/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>
