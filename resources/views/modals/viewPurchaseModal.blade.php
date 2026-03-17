<style>
    .tables table {
        font-size: 0.85rem;
    }
</style>

<div class="modal fade" id="viewPurchaseModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Purchasing Detail</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="tables">
                    <div class="firstTable">
                        <table class="table table-bordered table-sm">
                            <tr>
                                <th>Supplier</th>
                                <td id="modal-supplier"></td>
                            </tr>
                            <tr>
                                <th>Product</th>
                                <td id="modal-product"></td>
                            </tr>
                            <tr>
                                <th>Quantity</th>
                                <td id="modal-quantity"></td>
                            </tr>
                            <tr>
                                <th>Unit Price <span class="text-muted" style="font-size:0.65rem;">(ETB)</span></th>
                                <td id="modal-unitPrice"></td>
                            </tr>
                            <tr>
                                <th>Total Price <span class="text-muted" style="font-size:0.65rem;">(ETB)</span></th>
                                <td id="modal-totalPrice"></td>
                            </tr>
                            <tr>
                                <th>Tax Percent <span class="text-muted" style="font-size:0.65rem;">(%)</span></th>
                                <td id="modal-taxPercent"></td>
                            </tr>
                            <tr>
                                <th>Tax <span class="text-muted" style="font-size:0.65rem;">(ETB)</span></th>
                                <td id="modal-tax"></td>
                            </tr>
                            <tr>
                                <th>Grand Total <span class="text-muted" style="font-size:0.65rem;">(ETB)</span></th>
                                <td id="modal-grandTotal"></td>
                            </tr>
                            <tr>
                                <th>Purchase Date</th>
                                <td id="modal-purchaseDate"></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td id="modal-status"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
