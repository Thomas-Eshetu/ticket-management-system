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
                    <div class="addPurchaseContainer">
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
                        <form action="{{ route('purchase.save') }}" method="POST">
                            @csrf
                            <div class="row">

                                <div class="col-md-4 mb-3">
                                    <label for="" class="form-label">Supplier <span
                                            class="text-danger">*</span></label>
                                    <select name="supplier" id="" class="form-select" required>
                                        <option value="" disabled selected>Select</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->company_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-8 mb-3">
                                    <table class="table table-bordered" id="purchaseTable">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Qty</th>
                                                <th>Unit Price <span class="text-muted"
                                                        style="font-size: 0.7rem;">(ETB)</span></th>
                                                <th>Total <span class="text-muted"
                                                        style="font-size: 0.7rem;">(ETB)</span></th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <select name="product[]" class="form-select" required>
                                                        <option value="">Select</option>
                                                        @foreach ($products as $product)
                                                            <option value="{{ $product->id }}">
                                                                {{ $product->product_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input type="number" name="quantity[]"
                                                        class="form-control quantity" required></td>
                                                <td><input type="number" name="unitPrice[]"
                                                        class="form-control unitPrice" required></td>
                                                <td><input type="number" name="totalPrice[]"
                                                        class="form-control totalPrice" readonly></td>
                                                <td>
                                                    <button type="button"
                                                        class="btn btn-sm btn-danger removeRow">remove</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <button type="button" class="btn btn-primary btn-sm" id="addRow">+ Add
                                        Item</button>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="" class="form-label">Total Price <span class="text-muted"
                                            style="font-size:0.7rem;">(ETB)</span> <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="totalPrice" id="totalPrice"
                                        readonly required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="" class="form-label">Tax <span
                                            style="font-size:0.7rem;">(15%)</span> <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="tax" id="tax" readonly
                                        required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="" class="form-label">Grand Total <span class="text-muted"
                                            style="font-size:0.7rem;">(ETB)</span> <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="grandTotal" id="grandTotal"
                                        readonly required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="" class="form-label">Purchase Date <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="purchaseDate"
                                        min="{{ date('Y-m-d', strtotime('-5 days')) }}" max="{{ date('Y-m-d') }}"
                                        required>
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

    <script>
        // Add new row
        document.getElementById('addRow').addEventListener('click', function() {
            let table = document.querySelector('#purchaseTable tbody');
            let row = table.rows[0].cloneNode(true);

            row.querySelectorAll('input').forEach(input => input.value = '');

            table.appendChild(row);
        });

        // Remove row
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('removeRow')) {
                let rows = document.querySelectorAll('#purchaseTable tbody tr');
                if (rows.length > 1) {
                    e.target.closest('tr').remove();
                    calculateGrandTotal();
                }
            }
        });

        // Calculate row total
        document.addEventListener('input', function(e) {
            if (e.target.classList.contains('quantity') || e.target.classList.contains('unitPrice')) {

                let row = e.target.closest('tr');

                let qty = parseFloat(row.querySelector('.quantity').value) || 0;
                let price = parseFloat(row.querySelector('.unitPrice').value) || 0;

                let total = qty * price;

                row.querySelector('.totalPrice').value = total.toFixed(2);

                calculateGrandTotal();
            }
        });

        // Grand total
        function calculateGrandTotal() {
            let totals = document.querySelectorAll('.totalPrice');
            let sum = 0;

            totals.forEach(input => {
                sum += parseFloat(input.value) || 0;
            });

            document.getElementById('totalPrice').value = sum.toFixed(2);

            calculateTax();
        }

        // Tax + Grand total
        function calculateTax() {
            let total = parseFloat(document.getElementById('totalPrice').value) || 0;

            let tax = (total * 15) / 100;
            document.getElementById('tax').value = tax.toFixed(2);

            document.getElementById('grandTotal').value = (total + tax).toFixed(2);
        }

        document.getElementById('totalPrice').addEventListener('change', calculateTax);
    </script>

    {{-- <script>
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
