<style>
  .tables table{
    font-size: 0.85rem;
  }
</style>

<div class="modal fade" id="viewUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">User Detail</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="tables">
                    <div class="firstTable">
                        <table class="table table-bordered table-sm">
                            <tr><th>FUll Name</th><td id="modal-name"></td></tr>
                            <tr><th>Gender</th><td id="modal-gender"></td></tr>
                            <tr><th>Email</th><td id="modal-email"></td></tr>
                            <tr><th>Phone</th><td id="modal-phone"></td></tr>
                            <tr><th>Department</th><td id="modal-department"></td></tr>
                            <tr><th>Position</th><td id="modal-position"></td></tr>
                            <tr><th>Role</th><td id="modal-role"></td></tr>
                            <tr><th>Status</th><td id="modal-status"></td></tr>
                            <tr><th>Created At</th><td id="modal-createdAt"></td></tr>
                            <tr><th>Updated At</th><td id="modal-updatedAt"></td></tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <small>Yegna Ticketing System</small>
            </div>
        </div>
    </div>
</div>