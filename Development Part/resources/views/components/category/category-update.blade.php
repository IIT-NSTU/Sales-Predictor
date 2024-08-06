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
                                <label class="form-label">Category Name *</label>
                                <input type="text" class="form-control" id="categoryNameUpdate">
                                <input class="d-none" id="updateID">
                            </div>

                            <div class="d-flex mt-3">
                                <div class="form-check me-3">
                                    <input class="form-check-input" name="categoryType" type="radio" id="productTypeUpdate">
                                    <label for="productTypeUpdate"> Product </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="categoryType" type="radio" id="expenseTypeUpdate" >
                                    <label for="expenseTypeUpdate"> Expense </label>
                                </div>
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
    const handleUpdate = async () => {
        let updatedCatagoryName = document.getElementById('categoryNameUpdate').value;
        let categoryid = document.getElementById('updateID').value;



        if (updatedCatagoryName.length === 0) {
            errorToast("Provide Category Name");
        } else {
            // Close model
            document.getElementById('update-modal-close').click();

            showLoader();
            try {
                const expense = document.getElementById('expenseTypeUpdate');
                let type = "1";
                if (expense.checked) {
                    type = "2";
                }
                const res = await axios.post('/update-category', {
                    id: categoryid,
                    name: updatedCatagoryName,
                    type:type
                })
                hideLoader();
                successToast(res.data['message']);
                await getCategoryList();
            } catch (error) {
                hideLoader();
                errorToast('Category updating failed')
            }
        }

    }
</script>
