<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Purchasing - Add Purchase</title>
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
                        <li class="breadcrumb-item active">Add Purchase</li>
                    </ol>
                    <hr>
                    <div class="addContainer">
                        <h4 class="text-center">Add New Purchase</h4>

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
                        <form action="{{ route('product.save') }}" method="POST">
                            @csrf
                            <div class="row">

                                 <div class="col-md-6 mb-3">
                                    <label for="" class="form-label">Supplier <span
                                            class="text-danger">*</span></label>
                                    <select name="unit" id="" class="form-select" required>
                                        <option value="" disabled selected>Select</option>
                                        <option value="piece">Piece</option>
                                        <option value="meter">Meter</option>
                                        <option value="kg">Kg</option>
                                        <option value="litter">Litter</option>
                                    </select>
                                </div>

                                 <div class="col-md-6 mb-3">
                                    <label for="" class="form-label">Product <span
                                            class="text-danger">*</span></label>
                                    <select name="unit" id="" class="form-select" required>
                                        <option value="" disabled selected>Select</option>
                                        <option value="piece">Piece</option>
                                        <option value="meter">Meter</option>
                                        <option value="kg">Kg</option>
                                        <option value="litter">Litter</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="" class="form-label">Quantity <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="productType" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="" class="form-label">Unit Price <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="productName" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="" class="form-label">Total Price <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="productBrand" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="" class="form-label">Tax (%) <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="productCode" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="" class="form-label">Grand Total <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="productCode" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="" class="form-label">Purchase Date <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="productCode" required>
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
