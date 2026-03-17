<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Purchasing - Edit Purchase</title>
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
                        <li class="breadcrumb-item active">Edit Purchase</li>
                    </ol>
                    <hr>
                    <div class="addContainer">
                        <h4 class="text-center">Edit Purchase</h4>

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
                        <form action="{{ route('purchase.update', $purchase->id) }}" method="POST">
                            @csrf
                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label for="" class="form-label">Supplier <span
                                            class="text-danger">*</span></label>
                                    <select name="supplier" id="" class="form-select" required>
                                        <option value="{{ $purchase->supplierID }}" selected>{{ $purchase->supplierName }}</option>
                                        <option value="" disabled>Select</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->company_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="" class="form-label">Product <span
                                            class="text-danger">*</span></label>
                                    <select name="product" id="" class="form-select" required>
                                        <option value="{{ $purchase->productID }}" selected>{{ $purchase->productName }}</option>
                                        <option value="" disabled>Select</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="" class="form-label">Quantity <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="quantity" id="quantity" value="{{ $purchase->quantity }}" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="" class="form-label">Unit Price <span class="text-muted" style="font-size:0.75rem;">(ETB)</span> <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="unitPrice" id="unitPrice" value="{{ $purchase->unit_price }}" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="" class="form-label">Total Price <span class="text-muted" style="font-size:0.75rem;">(ETB)</span> <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="totalPrice" id="totalPrice" value="{{ $purchase->total_price }}"
                                     readonly   required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="" class="form-label">Tax (%) <span
                                            class="text-danger">*</span></label>
                                    <select name="taxtPercent" id="taxPercent" class="form-select col-md-4" required>
                                        <option value="{{ $purchase->tax_percent}}">{{ $purchase->tax_percent . ' %' }}</option>
                                        <option value="" disabled>Select</option>
                                        <option value="2">2 %</option>
                                        <option value="5">5 %</option>
                                        <option value="10">10 %</option>
                                        <option value="12">12 %</option>
                                        <option value="15">15 %</option>
                                    </select>
                                    <input type="number" class="form-control" name="tax" id="tax" value="{{ $purchase->tax }}" readonly required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="" class="form-label">Grand Total <span class="text-muted" style="font-size:0.75rem;">(ETB)</span> <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="grandTotal" id="grandTotal" value="{{ $purchase->grand_total }}"
                                      readonly  required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="" class="form-label">Purchase Date <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="purchaseDate" max="{{ date('Y-m-d') }}" value="{{ $purchase->purchase_date }}" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="" class="form-label">Status <span
                                            class="text-danger">*</span></label>
                                            <select name="status" id="" class="form-select" required>
                                                <option value="{{ $purchase->status }}">{{ $purchase->status }}</option>
                                                <option value="received">Received</option>
                                                <option value="stocked">Stocked</option>
                                            </select>
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

    <script>
        function calculateTotal() {

            let quantity = parseFloat(document.getElementById('quantity').value) || 0;
            let unitPrice = parseFloat(document.getElementById('unitPrice').value) || 0;
            let taxPercent = parseFloat(document.getElementById('taxPercent').value) || 0;

            let totalPrice = quantity * unitPrice;
            document.getElementById('totalPrice').value = totalPrice.toFixed(2);

            let tax = (totalPrice * taxPercent) / 100;
            document.getElementById('tax').value = tax.toFixed(2);

            let grandTotal = totalPrice + tax;
            document.getElementById('grandTotal').value = grandTotal.toFixed(2);
        }

        document.getElementById('quantity').addEventListener('input', calculateTotal);
        document.getElementById('unitPrice').addEventListener('input', calculateTotal);
        document.getElementById('taxPercent').addEventListener('change', calculateTotal);
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
