<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin - View Purchaser</title>
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
                    
                    <ol class="breadcrumb mt-2 mb-4">
                        <li class="breadcrumb-item active">View Purchasers</li>
                    </ol>
                    <hr>
                    {{-- @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif --}}



                    <div class="table-responsive viewContainer">
                        <table class="table table-bordered table-striped" id="usersTable">
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
                                            @elseif ($user->role === 'purchaser')
                                                <span class="badge bg-warning text-dark">Purchaser</span>
                                            @else
                                                <span class="badge bg-danger">Unidentified</span>
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
                                            <a href="" class="badge bg-primary text-white" title="View User"
                                                data-bs-toggle="modal" data-bs-target="#viewUserModal"
                                                data-id="{{ $user->id }}" data-name="{{ $user->name }}"
                                                data-gender="{{ $user->gender }}" data-email="{{ $user->email }}"
                                                data-phone="{{ $user->phone }}"
                                                data-department="{{ $user->department }}"
                                                data-position="{{ $user->position }}" data-role="{{ $user->role }}"
                                                data-status="{{ $user->status }}"
                                                data-created_at="{{ $user->created_at }}"
                                                data-updated_at="{{ $user->updated_at }}"><i
                                                    class="fas fa-eye"></i></a>
                                            <a href="{{ url('/edit-user', $user->id) }}"
                                                class="badge bg-warning text-white" title="Edit User"><i
                                                    class="fas fa-edit"></i></a>
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
            @include('components.adminFooter')

        </div>
    </div>

    @include('modals.viewUserModal')

    <script>
        $(document).ready(function() {
            $('#usersTable').DataTable({
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

    <!---Script to populate the modal--->
    <script>
        document.getElementById('viewUserModal').addEventListener('show.bs.modal', function(event) {
            const btn = event.relatedTarget;

            document.getElementById('modal-name').textContent = btn.getAttribute('data-name');
            document.getElementById('modal-gender').textContent = btn.getAttribute('data-gender');
            document.getElementById('modal-email').textContent = btn.getAttribute('data-email');
            document.getElementById('modal-phone').textContent = btn.getAttribute('data-phone');
            document.getElementById('modal-department').textContent = btn.getAttribute('data-department');
            document.getElementById('modal-position').textContent = btn.getAttribute('data-position');
            document.getElementById('modal-role').textContent = btn.getAttribute('data-role');
            document.getElementById('modal-status').textContent = btn.getAttribute('data-status');
            document.getElementById('modal-createdAt').textContent = btn.getAttribute('data-created_at');
            document.getElementById('modal-updatedAt').textContent = btn.getAttribute('data-updated_at');
        });
    </script>

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
