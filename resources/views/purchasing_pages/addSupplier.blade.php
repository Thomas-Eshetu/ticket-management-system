<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Purchasing - Add Supplier</title>
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
                    <ol class="breadcrumb mt-3 mb-4">
                        <li class="breadcrumb-item active">Add Supplier</li>
                    </ol>
                    <hr>
                    <div class="addContainer">
                        <h4 class="text-center">Add New Supplier</h4>

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
                        <hr>
                        <form action="{{ route('supplier.save') }}" method="POST">
                            @csrf
                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label for="" class="form-label">Company Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="companyName" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="" class="form-label">Trade Type <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="tradeType" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="" class="form-label">Phone <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="phone" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="" class="form-label">Country <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="country" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="" class="form-label">City <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="city" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="" class="form-label">Address <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="address" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="" class="form-label">Tin Number <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="tinNo" required>
                                </div>

                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-success">
                                    Save <i class="fas fa-save"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </main>
            @include('components.adminFooter')

        </div>
    </div>

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Validation Error!',
                confirmButtonColor: '#4F0F06',
                html: `{!! implode('<br>', $errors->all()) !!}`,
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
