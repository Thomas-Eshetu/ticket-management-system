<style>
  .tables table{
    font-size: 0.85rem;
  }
</style>

<div class="modal fade" id="staffViewTicketModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Ticket Detail</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="tables">
                    <div class="firstTable">
                        <table class="table table-bordered table-sm">
                            <tr><th>Ticket No.</th>
                              <td class="badge bg-secondary p-1 m-2" id="modal-ticket-number"></td>
                            </tr>
                            <tr><th>Requester</th><td id="modal-requester"></td></tr>
                            <tr><th>Affected Dep't</th><td id="modal-department"></td></tr>
                            <tr><th>Issue Type</th><td id="modal-issue-type"></td></tr>
                            <tr><th>Issue Start At</th><td id="modal-issue-start"></td></tr>
                            <tr><th>Affected Users Count</th><td id="modal-affected-users"></td></tr>
                            <tr><th>Status</th><td id="modal-status"></td></tr>
                        </table>
                    </div>
                    <div class="secondTable">
                        <table class="table table-bordered">
                            <tr><th>Subject</th><td id="modal-subject"></td></tr>
                            <tr><th>Description</th><td id="modal-description"></td></tr>
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