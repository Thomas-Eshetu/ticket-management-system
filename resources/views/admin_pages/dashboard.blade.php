<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="/css/adminStyle.css" rel="stylesheet" />
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
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
                    <h3 class="mt-4">Dashboard</h3>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard <i class="fa-solid fa-gauge"></i></li>
                    </ol>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body fw-bold"><i class="fa-solid fa-circle-dot"></i> &nbsp; Active
                                    Tickets <span class="badge position-absolute top-0 start-100 translate-middle"
                                        style="background: #BA0000;">{{ $activeTickets }}</span></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <div class="small text-white"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body fw-bold"><i class="fa-regular fa-hourglass-half"></i> &nbsp;
                                    Pending Tickets <span
                                        class="badge position-absolute top-0 start-100 translate-middle"
                                        style="background: #BA0000;">{{ $pendingTickets }}</span></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">

                                    <div class="small text-white"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body fw-bold"><i class="fa-solid fa-clock"></i> &nbsp; Delayed Tickets
                                    <span class="badge position-absolute top-0 start-100 translate-middle"
                                        style="background: #BA0000;">{{ $delayedTickets }}</span>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <div class="small text-white"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body fw-bold"><i class="fa-solid fa-clock"></i> &nbsp; Resolved Tickets
                                    <span class="badge position-absolute top-0 start-100 translate-middle"
                                        style="background: #BA0000;">{{ $resolvedTickets }}</span>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <div class="small text-white"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        const days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
                        const createdTickets = @json($trendData['created']);
                        const resolvedTickets = @json($trendData['resolved']);
                    </script>

                    <script>
                        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

                        const monthlyTickets = @json($monthlyData);
                    </script>

                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-area me-1"></i>
                                    Weekly Analytics
                                </div>
                                <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar me-1"></i>
                                    Monthly Analytics
                                </div>
                                <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Recent Tickets
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Department</th>
                                        <th>Issue Type</th>
                                        <th>Issue Started At</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentTickets as $recentTicket)
                                        <tr>
                                            <td>{{ $recentTicket->department }}</td>
                                            <td>{{ $recentTicket->issue_type }}</td>
                                            <td>{{ $recentTicket->issue_start_date }}</td>
                                            <td>
                                                @if ($recentTicket->status === 'open')
                                                    <span class="badge bg-primary">{{ $recentTicket->status }}</span>
                                                @elseif ($recentTicket->status === 'pending')
                                                    <span class="badge bg-warning">{{ $recentTicket->status }}</span>
                                                @elseif ($recentTicket->status === 'resolved')
                                                    <span class="badge bg-success">{{ $recentTicket->status }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            @include('components.adminFooter')

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="charts/chart-area-demo.js"></script>
    <script src="charts/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
</body>

</html>
