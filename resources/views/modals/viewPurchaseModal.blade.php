<style>
    .tables table {
        font-size: 0.85rem;
    }
</style>

<div class="modal fade" id="viewPurchaseModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Purchasing Detail</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="tables">
                    <div class="firstTable">
                        <div class="card">
                            <div class="card-header">
                                <p class="fw-bold">Supplier Information</p>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-sm">
                                    <tr>
                                        <th>Company Name</th>
                                        <td id="modal-supplier"></td>
                                    </tr>
                                    <tr>
                                        <th>Trade Type</th>
                                        <td id="modal-tradeType"></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td id="modal-supplierEmail"></td>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <td id="modal-supplierPhone"></td>
                                    </tr>
                                    <tr>
                                        <th>Country</th>
                                        <td id="modal-supplierCountry"></td>
                                    </tr>
                                    <tr>
                                        <th>City</th>
                                        <td id="modal-supplierCity"></td>
                                    </tr>
                                    <tr>
                                        <th>Address</th>
                                        <td id="modal-supplierAddress"></td>
                                    </tr>
                                    <tr>
                                        <th>Tin No.</th>
                                        <td id="modal-tinNo"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div id="modal-loading" class="text-center my-3" style="display:none;">
                            <div class="spinner-border text-primary"></div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header">
                                <p class="fw-bold">Items Information</p>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th>Product Type</th>
                                            <th>Product Name</th>
                                            <th>Product Brand</th>
                                            <th>Quantity</th>
                                            <th>Unit Price <span class="text-muted"
                                                    style="font-size:0.65rem;">(ETB)</span></th>
                                            <th>Total Price <span class="text-muted"
                                                    style="font-size:0.65rem;">(ETB)</span></th>
                                            <th>Purchase Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>

                                    <tbody id="modal-items">
                                        <tr>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <div class="totalAmount" style="width: 40%;">
                                <div class="card mt-3">
                                    <div class="card-header">
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-bordered table-sm">
                                            <tr>
                                                <th>Total Before Tax <span class="text-muted"
                                                        style="font-size:0.65rem;">(ETB)</span></th>
                                                <td id="modal-totalPriceAll"></td>
                                            </tr>
                                            <tr>
                                                <th>Tax <span class="text-muted" style="font-size:0.65rem;">(15%)</span>
                                                </th>
                                                <td id="modal-tax"></td>
                                            </tr>
                                            <tr>
                                                <th>Grand Total <span class="text-muted"
                                                        style="font-size:0.65rem;">(ETB)</span>
                                                </th>
                                                <td id="modal-grandTotal"></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
