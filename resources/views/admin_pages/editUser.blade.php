<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin - Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="/css/adminStyle.css" rel="stylesheet" />
    <link href="/css/style.css" rel="stylesheet" />
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
                    <h1 class="mt-4">User Management</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Edit User</li>
                    </ol>
                    <div class="addContainer">
                        <h4 class="text-center">Update Staff User</h4>

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <hr>
                        <form action="{{ route('staff.store') }}" method="POST">
                            @csrf
                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text">Staff Name</span>
                                        <input type="text" class="form-control" name="staffName" required>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="input-group">
                                        <select class="form-select" name="gender" required>
                                            <option value="" selected disabled>Select Gender</option>
                                            <hr style="color: #F7F7F7";>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text">Email</span>
                                        <input type="text" class="form-control" name="email" required>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text">Phone</span>
                                        <input type="text" class="form-control" name="phone" required>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text">Department</span>
                                        <input type="text" class="form-control" name="department" required>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text">Position</span>
                                        <input type="text" class="form-control" name="position" required>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="input-group">
                                        <select class="form-select" name="role" required>
                                            <option value="" selected disabled>Select Role</option>
                                            <hr style="color: #F7F7F7";>
                                            <option value="staff">Staff</option>
                                            <option value="admin">Admin</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="input-group">
                                        <span class="input-group-text">Username</span>
                                        <input type="text" class="form-control" name="userName" required>
                                    </div>
                                </div>

                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-success">
                                    Update <i class="fas fa-edit"></i>
                                </button>
                            </div>
                        </form>
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
