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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Staff - Dashboard</title>

</head>

<body>

    @include('components.staffNavbar')

    <div class="staffContainer">
        @include('components.staffSidebar')
        <div class="main">
            <div class="cards">

                <div class="card-group">

                    <div class="card rounded-4">
                        <div class="card-header">
                            <span class="badge bg-primary">{{ $openTickets }}</span>
                        </div>
                        <div class="card-body text-bg-primary">
                            <p>Raised Tickets</p>
                        </div>
                    </div>

                    <div class="card rounded-4">
                        <div class="card-header">
                            <span class="badge bg-warning">{{ $pendingTickets }}</span>
                        </div>
                        <div class="card-body text-bg-warning">
                            <p>Pending Tickets</p>
                        </div>
                    </div>

                    <div class="card rounded-4">
                        <div class="card-header">
                            <span class="badge bg-success">{{ $resolvedTickets }}</span>
                        </div>
                        <div class="card-body text-bg-success">
                            <p>Resolved Tickets</p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="dataContainer">
                <div class="chartContainer">

                    <div class="card">
                        <div class="card-header">
                            <strong>Ticket Statistics</strong>
                        </div>

                        <div class="card-body">

                            <ul class="nav nav-tabs" id="ticketTabs">
                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#daily">Daily</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#weekly">Weekly</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#monthly">Monthly</button>
                                </li>
                            </ul>

                            <div class="tab-content mt-3">

                                <div class="tab-pane fade show active" id="daily">
                                    <canvas id="dailyChart"></canvas>
                                </div>

                                <div class="tab-pane fade" id="weekly">
                                    <canvas id="weeklyChart"></canvas>
                                </div>

                                <div class="tab-pane fade" id="monthly">
                                    <canvas id="monthlyChart"></canvas>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <div class="tableContainer">
                    <div class="card">
                        <div class="card-header">
                            <strong>Recent Tickets</strong>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <th>Ticket No.</th>
                                    <th>Issue Type</th>
                                    <th>Affected Dep't</th>
                                    <th>Issue Started At</th>
                                    <th>Status</th>
                                </thead>
                                <tbody>
                                    @foreach ($recentTickets as $recentTicket)
                                        <tr>
                                            <td><span
                                                    class="badge bg-secondary">{{ $recentTicket->ticket_number }}</span>
                                            </td>
                                            <td>{{ $recentTicket->issue_type }}</td>
                                            <td>{{ $recentTicket->department }}</td>
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
            </div>



        </div>

    </div>
    <hr>
    <span class="fs-8 text-center d-block">&copy; 2026, All rights reserved!</span>


    <!---Daily Tickets-->
    <script>
        const dailyLabels = [
            @foreach ($dailyTickets as $ticket)
                "{{ $ticket->date }}",
            @endforeach
        ];

        const dailyData = [
            @foreach ($dailyTickets as $ticket)
                {{ $ticket->total }},
            @endforeach
        ];

        new Chart(document.getElementById('dailyChart'), {
            type: 'line',
            data: {
                labels: dailyLabels,
                datasets: [{
                    label: 'Daily Tickets',
                    data: dailyData,
                    borderColor: '#0d6efd',
                    backgroundColor: 'rgba(13,110,253,0.2)',
                    fill: true,
                    tension: 0.4
                }]
            }
        });
    </script>

    <!---Weekly tickets--->
    <script>
        const weeklyLabels = [
            @foreach ($weeklyTickets as $ticket)
                "Week {{ $ticket->week }}",
            @endforeach
        ];

        const weeklyData = [
            @foreach ($weeklyTickets as $ticket)
                {{ $ticket->total }},
            @endforeach
        ];

        new Chart(document.getElementById('weeklyChart'), {
            type: 'bar',
            data: {
                labels: weeklyLabels,
                datasets: [{
                    label: 'Weekly Tickets',
                    data: weeklyData,
                    backgroundColor: '#ffc107'
                }]
            }
        });
    </script>


    <!---Monthly Tickets-->
    <script>
        const monthlyLabels = [
            @foreach ($monthlyTickets as $ticket)
                "{{ $ticket->month }}",
            @endforeach
        ];

        const monthlyData = [
            @foreach ($monthlyTickets as $ticket)
                {{ $ticket->total }},
            @endforeach
        ];

        new Chart(document.getElementById('monthlyChart'), {
            type: 'bar',
            data: {
                labels: monthlyLabels,
                datasets: [{
                    label: 'Monthly Tickets',
                    data: monthlyData,
                    backgroundColor: '#198754'
                }]
            }
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
