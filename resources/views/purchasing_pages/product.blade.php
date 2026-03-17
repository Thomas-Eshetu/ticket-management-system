<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Purchasing - Product </title>
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
                        <li class="breadcrumb-item active">View Products</li>
                    </ol>
                    <hr>
                    {{-- @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif --}}



                    <div class="table-responsive viewContainer" style="font-size: 0.9rem;">
                        <div class="addBtn text-end mb-3">
                            <a href="{{ route('view.addProduct') }}" class="btn btn-primary"><i
                                    class="fa-regular fa-square-plus"></i> Add
                                Product</a>
                        </div>

                        <table class="table table-bordered table-striped" id="usersTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product Code</th>
                                    <th>Product Type</th>
                                    <th>Product Name</th>
                                    <th>Product Brand</th>
                                    <th>Unit</th>
                                    <th>Quantity</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $product->product_code }}</td>
                                        <td>{{ $product->product_type }}</td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->product_brand }}</td>
                                        <td>{{ $product->unit }}</td>
                                        <td>{{ $product->quantity }}</td>
                                        <td>
                                            @if ($product->quantity == 0)
                                                <span class="badge bg-danger">out of stock</span>
                                            @elseif ($product->quantity < 5)
                                                <span class="badge bg-warning">low stock</span>
                                            @else
                                                <span
                                                    class="{{ $product->status == 'active' ? 'badge bg-success' : 'badge bg-danger' }}">{{ $product->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="" class="badge bg-primary">View</a>
                                            <a href="" class="badge bg-warning">Edit</a>
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
    {{-- <script>
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
    </script> --}}

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
