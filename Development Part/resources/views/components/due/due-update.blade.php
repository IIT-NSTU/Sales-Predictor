<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Update Due Amount</h6>
            </div>
            <div class="modal-body">
                <form id="add-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label d-none">Due ID *</label>
                                <input type="text" class="form-control d-none" id="DId">
                                <input type="text" class="form-control d-none" id="CId">
                                <label class="form-label d-none">Actual Amount *</label>
                                <input type="text" class="form-control d-none" id="DActAmount">
                                <p class="form-label">Date: 
                                    <input id="updateDate" value="{{ date('Y-m-d') }}" />
                                </p>
                                <label class="form-label">Enter Amount *</label>
                                <input type="text" class="form-control" id="DAmount">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal"
                    aria-label="Close">Close</button>
                <button onclick="add()" id="save-btn" class="btn btn-sm   btn-success">Add</button>
            </div>
        </div>
    </div>
</div>

<script>
    const add = async () => {
        let Id = document.getElementById('DId').value;
        let CId = document.getElementById('CId').value;
        let actualAmount = parseFloat(document.getElementById('DActAmount').value);
        let amount = document.getElementById('DAmount').value;
        let cnvAmount = parseFloat(amount);
        let date = document.getElementById('updateDate').value;

        if (amount.length === 0) {
            errorToast('Due amount is required');
        } else if (cnvAmount <= 0) {
            errorToast('Sorry! Please enter a positive amount.');
        } else if (actualAmount < cnvAmount) {
            errorToast('Sorry! Due amount (' + actualAmount +') is less than your given amount (' + cnvAmount +').');
        } else {
            try {
                const res = await axios.post('/update-due', {
                    id:Id,
                    cid:CId,
                    date:date,
                    amount:cnvAmount
                });
                successToast(res['data']['message']);
                $('#create-modal').modal('hide')
                getDueList();
            } catch (error) {
                errorToast('Failed to update due.');
            }
        }
    }
</script>