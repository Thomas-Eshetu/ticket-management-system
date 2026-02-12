<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin - View Users</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="/css/adminStyle.css" rel="stylesheet" />
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
                    <h3 class="mt-4">User Management</h3>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">View User</li>
                    </ol>

                    {{-- @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif --}}



                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                    <th>Created At</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }} </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>
                                            @if ($user->role === 'admin')
                                                <span class="badge bg-primary">Administrator</span>
                                            @elseif ($user->role === 'staff')
                                                <span class="badge bg-secondary">Staff</span>
                                            @endif
                                        </td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>
                                            @if ($user->status === 'active')
                                                <span class="badge bg-success">{{ $user->status }}</span>
                                            @elseif ($user->status === 'deactive')
                                                <span class="badge bg-danger">{{ $user->status }}</span>
                                            @elseif ($user->status === 'locked')
                                                <span class="badge bg-warning">{{ $user->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="" class="badge bg-primary text-white" title="View User"><i
                                                    class="fas fa-eye"></i></a>
                                            <a href="{{ url('/edit-user', $user->id) }}" class="badge bg-warning text-white"
                                                title="Edit User"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('reset.user', $user->id) }}"
                                                class="badge bg-warning text-white reset-btn"
                                                data-url="{{ route('reset.user', $user->id) }}" title="Reset Password">
                                                <i class="fas fa-key"></i>
                                            </a>

                                            @if ($user->status === 'locked')
                                                <a href="" class="badge bg-warning text-white unlock-btn"
                                                    title="Unlock User"
                                                    data-url="{{ route('active.user', $user->id) }}"><i
                                                        class="fas fa-unlock"></i></a>
                                            @elseif ($user->status === 'deactive')
                                                <a href="{{ route('active.user', $user->id) }}"
                                                    class="badge bg-success text-white active-btn" title="Activate User"
                                                    data-url="{{ route('active.user', $user->id) }}"><i
                                                        class="fa-solid fa-user-check"></i></a>
                                            @elseif ($user->status === 'active')
                                                <a href="{{ route('deactive.user', $user->id) }}"
                                                    class="badge bg-danger text-white deactive-btn"
                                                    title="Deactivate User"
                                                    data-url="{{ route('deactive.user', $user->id) }}"><i
                                                        class="fa-solid fa-ban"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2026</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            document.querySelectorAll('.reset-btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault(); // stop default link

                    let url = this.getAttribute('data-url');

                    Swal.fire({
                        width: 400,
                        title: "Are you sure?",
                        text: "This will reset the user's password!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Yes, reset it!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = url; // proceed
                        }
                    });
                });
            });

            document.querySelectorAll('.active-btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    let url = this.getAttribute('data-url');
                    Swal.fire({
                        width: 400,
                        title: "Are you sure to activate user?",
                        text: "This will activate the user!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#0E8C0E",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Yes, Activate!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = url;
                        }
                    });
                });
            });

            document.querySelectorAll('.unlock-btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    let url = this.getAttribute('data-url');
                    Swal.fire({
                        width: 400,
                        title: "Are you sure to unlock user?",
                        text: "This will unlock the user!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#0E8C0E",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Yes, Unlock!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = url;
                        }
                    });
                });
            });


            document.querySelectorAll('.deactive-btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    let url = this.getAttribute('data-url');
                    Swal.fire({
                        width: 400,
                        title: "Are you sure to deactivate user?",
                        text: "This will deactivate the user!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#D11C00",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Yes, Deactivate!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = url;
                        }
                    });
                });
            });

        });
    </script>

    @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
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
