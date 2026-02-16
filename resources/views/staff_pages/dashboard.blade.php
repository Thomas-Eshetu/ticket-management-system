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
    <title>Staff - Dashboard</title>
</head>

<body>
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-primary">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="">Staff <i class="fas fa-users"></i></a>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            {{-- <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..."
                    aria-describedby="btnNavbarSearch" />
                <button class="btn" id="btnNavbarSearch" type="button" style="background:#2752B0; color: #ffff;"><i
                        class="fas fa-search"></i></button>
            </div> --}}
            <span class="text-white">Hello, Staff User</span>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!"><i class="fa-solid fa-wrench"></i> Settings</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="{{ route('logout') }}"><i
                                class="fa-solid fa-arrow-right-from-bracket text-danger"></i> Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div class="staffContainer">
        <div class="sideBar">
            <span>Dashborad</span>
        </div>
        <div class="main">
            <div class="cards">

                <div class="card-group">

                    <div class="card rounded-4">
                        <div class="card-header">
                            <span class="badge bg-primary">3</span>
                        </div>
                        <div class="card-body text-bg-primary">
                                <p>Raised Tickets</p>
                        </div>
                    </div>

                    <div class="card rounded-4">
                        <div class="card-header">
                            <span class="badge bg-warning">3</span>
                        </div>
                        <div class="card-body text-bg-warning">
                                <p>Pending Tickets</p>
                        </div>
                    </div>

                    <div class="card rounded-4">
                        <div class="card-header">
                            <span class="badge bg-success">3</span>
                        </div>
                        <div class="card-body text-bg-success">
                                <p>Resolved Tickets</p>
                        </div>
                    </div>

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
