<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Purchasing - Purchase </title>
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
                        <li class="breadcrumb-item active">View Purchases</li>
                    </ol>
                    <hr>
                    {{-- @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif --}}



                    <div class="table-responsive viewContainer" style="font-size: 0.9rem;">
                        <div class="addBtn text-end mb-3">
                            <a href="{{ route('view.addPurchase') }}" class="btn btn-primary"><i
                                    class="fa-regular fa-square-plus"></i> Add
                                Purchase</a>
                        </div>

                        <table class="table table-bordered table-striped" id="usersTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Supplier</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Unit Price <span class="text-muted" style="font-size:0.75rem;">(ETB)</span></th>
                                    <th>Total Price <span class="text-muted" style="font-size:0.75rem;">(ETB)</span>
                                    </th>
                                    <th>Tax <span class="text-muted" style="font-size:0.75rem;">(ETB)</span></th>
                                    <th>Grand Total <span class="text-muted" style="font-size:0.75rem;">(ETB)</span>
                                    </th>
                                    <th>Purchase Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($purchases as $purchase)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $purchase->supplierName }}</td>
                                        <td>{{ $purchase->productName }}</td>
                                        <td>{{ $purchase->quantity }}</td>
                                        <td>{{ $purchase->unit_price }}</td>
                                        <td>{{ $purchase->total_price }}</td>
                                        <td>{{ $purchase->tax }}</td>
                                        <td>{{ $purchase->grand_total }}</td>
                                        <td>{{ $purchase->purchase_date }}</td>
                                        <td>
                                            @if ($purchase->status == 'pending')
                                                <span class="badge bg-warning">{{ $purchase->status }}</span>
                                            @elseif ($purchase->status == 'received')
                                                <span class="badge bg-primary">{{ $purchase->status }}</span>
                                            @elseif ($purchase->status == 'stocked')
                                                <span class="badge bg-success">{{ $purchase->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="" data-bs-toggle="modal" data-bs-target="#viewPurchaseModal"
                                                class="badge bg-primary"
                                                data-supplierName="{{ $purchase->supplierName }}"
                                                data-productName="{{ $purchase->productName }}"
                                                data-quantity="{{ $purchase->quantity }}"
                                                data-unitPrice="{{ $purchase->unit_price }}"
                                                data-totalPrice="{{ $purchase->total_price }}"
                                                data-taxPercent="{{ $purchase->tax_percent }}"
                                                data-tax="{{ $purchase->tax }}"
                                                data-grandTotal="{{ $purchase->grand_total }}"
                                                data-purchaseDate="{{ $purchase->purchase_date }}"
                                                data-status="{{ $purchase->status }}">view</a>

                                            @if ($purchase->status !== 'stocked')
                                                <a href="{{ route('purchase.edit', $purchase->id) }}"
                                                    class="badge bg-warning">Edit</a>
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

    @include('modals.viewPurchaseModal')

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
        document.getElementById('viewPurchaseModal').addEventListener('show.bs.modal', function(event) {
            const btn = event.relatedTarget;
            let unitPrice = btn.getAttribute('data-unitPrice');
            let totalPrice = btn.getAttribute('data-totalPrice');
            let tax = btn.getAttribute('data-tax');
            let grandTotal = btn.getAttribute('data-grandTotal');

            document.getElementById('modal-supplier').textContent = btn.getAttribute('data-supplierName');
            document.getElementById('modal-product').textContent = btn.getAttribute('data-productName');
            document.getElementById('modal-quantity').textContent = btn.getAttribute('data-quantity');

            document.getElementById('modal-unitPrice').textContent =
                Number(unitPrice).toLocaleString(undefined, {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
            document.getElementById('modal-totalPrice').textContent =
                Number(totalPrice).toLocaleString(undefined, {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });

            document.getElementById('modal-taxPercent').textContent = btn.getAttribute('data-taxPercent');

            document.getElementById('modal-tax').textContent = Number(tax).toLocaleString(undefined, {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });

            document.getElementById('modal-grandTotal').textContent = Number(grandTotal).toLocaleString(undefined, {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });

            document.getElementById('modal-purchaseDate').textContent = btn.getAttribute('data-purchaseDate');

            let status = btn.getAttribute('data-status');
            let statusElement = document.getElementById('modal-status');

            if (status === 'stocked') {
                statusElement.innerHTML = '<span class="badge bg-success">' + status + '</span>';
            } else if (status === 'received') {
                statusElement.innerHTML = '<span class="badge bg-primary">' + status + '</span>';
            } else if (status === 'pending') {
                statusElement.innerHTML = '<span class="badge bg-warning">' + status + '</span>';
            } else {
                statusElement.innerHTML = '<span class="badge bg-secondary">' + status + '</span>';
            }
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
