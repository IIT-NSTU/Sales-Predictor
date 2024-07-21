<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Select Expense Category *</label>
                                <select type="text" class="form-control form-select" id="expenseCategoryUpdate">
                                </select>
                                <label class="form-label">Amount *</label>
                                <input type="text" class="form-control" id="expenseAmountUpdate">
                                <label class="form-label">Comments </label>
                                <input type="text" class="form-control" id="expenseCommentUpdate">
                                <input type="text" class="d-none" id="updateID">
                            </div> 
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal"
                    aria-label="Close">Close</button>
                <button onclick="handleUpdate()" id="update-btn" class="btn btn-sm  btn-success">Update</button>
            </div>
        </div>
    </div>
</div>

<script>
    const fillUpdateExpenseDropDown = async () => {
        const expenseDropdown = document.getElementById('expenseCategoryUpdate');

        // Reset category option before Dom
        expenseDropdown.innerHTML = '';

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

    async function FillUpUpdateForm(id) {
        document.getElementById('updateID').value = id;
        showLoader();
        await fillUpdateExpenseDropDown();
        try {
            const res = await axios.get(`/expenses/${id}`)
            hideLoader();
            document.getElementById('expenseCategoryUpdate').value = res.data['category_id'];
            document.getElementById('expenseAmountUpdate').value = res.data['amount'];
            document.getElementById('expenseCommentUpdate').value = res.data['comment'];
        } catch (error) {
            console.log(error);
        }
    }
    
    const handleUpdate = async () => {
        let id = document.getElementById('updateID').value;
        let category_id = document.getElementById('expenseCategoryUpdate').value;
        let amount = document.getElementById('expenseAmountUpdate').value
        let comment = document.getElementById('expenseCommentUpdate').value;

        if (amount.length === 0) {
            errorToast("Expense amount is Required");
        } else if (parseFloat(amount) <= 0) {
            errorToast("Sorry! Please enter a positive expense amount.");
        }  else {
            // Close model
            document.getElementById('update-modal-close').click();

            showLoader();
            try {
                const res = await axios.post('/update-expense', {
                    id: id,
                    category_id: category_id,
                    amount:amount,
                    comment:comment
                })
                hideLoader();
                successToast(res.data['message']);
                await getExpenseList();
            } catch (error) {
                hideLoader();
                errorToast('Expense updating failed')
            }
        }

    }
</script>
