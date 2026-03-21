<style>
    .tables table {
        font-size: 0.85rem;
    }
</style>

<div class="modal fade" id="viewProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold">Product Detail</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="tables">
                    <div class="firstTable">
                        <div class="card">
                            <div class="card-header">
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-sm">
                                    <tr>
                                        <th>Product Code</th>
                                        <td id="modal-productCode"></td>
                                    </tr>
                                    <tr>
                                        <th>Product Type</th>
                                        <td id="modal-productType"></td>
                                    </tr>
                                    <tr>
                                        <th>Product Brand</th>
                                        <td id="modal-productBrand"></td>
                                    </tr>
                                    <tr>
                                        <th>Product Name</th>
                                        <td id="modal-productName"></td>
                                    </tr>
                                    <tr>
                                        <th>Unit</th>
                                        <td id="modal-unit"></td>
                                    </tr>
                                    <tr>
                                        <th>Stocked Amount</th>
                                        <td id="modal-quantity"></td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td id="modal-status"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div id="modal-loading" class="text-center my-3" style="display:none;">
                            <div class="spinner-border text-primary"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
