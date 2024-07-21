<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Expense</h5>
            </div>
            <div class="modal-body">
                <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Select Expense Category *</label>
                                <select type="text" class="form-control form-select" id="expenseCategory">
                                </select>
                                <label class="form-label">Amount *</label>
                                <input type="text" class="form-control" id="expenseAmount">
                                <label class="form-label">Comments </label>
                                <input type="text" class="form-control" id="expenseComment">
                            </div>      
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal"
                    aria-label="Close">Close</button>
                <button onclick="handleSave()" id="save-btn" class="btn btn-sm  btn-success">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    const fillExpenseDropDown = async () => {
        const expenseDropdown = document.getElementById('expenseCategory');

        try {
            const res = await axios.get('/categorybytype/2');
            res.data.map(category => {
                expenseDropdown.innerHTML += (
                    `<option value="${category['id']}">
                        ${category['name']}
                    </option>`);
            })
        } catch (error) {
            console.log(error);
        }
    }
    fillExpenseDropDown();

    const handleSave = async () => {
        const category = document.getElementById('expenseCategory').value;
        const amount = document.getElementById('expenseAmount').value;
        const comment = document.getElementById('expenseComment').value;

        // Validation
        if (amount.length === 0) {
            errorToast("Expense amount is Required");
        } else if (parseFloat(amount) <= 0) {
            errorToast("Sorry! Please enter a positive expense amount.");
        } else {
            // Close model
            document.getElementById('modal-close').click();
            
            showLoader();
            try {
                const res = await axios.post('/create-expense', {
                    category_id:category,
                    comment:comment,
                    amount:amount
                })
                hideLoader();
                successToast(res.data['message'])
                document.getElementById('save-form').reset();
                await getExpenseList();
            } catch (error) {
                hideLoader();
                errorToast(error.response.data.message);
            }
        }
    }
</script>
