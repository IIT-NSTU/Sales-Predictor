<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Contact</h5>
            </div>
            <div class="modal-body">
                <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Name *</label>
                                <input type="text" class="form-control" id="customerName">
                                <label class="form-label">Address *</label>
                                <input type="text" class="form-control" id="customerAddress">
                                <label class="form-label">Mobile Numbers (comma separated) *</label>
                                <input type="text" class="form-control" id="customerMobile">
                                <label class="form-label">Email </label>
                                <input type="text" class="form-control" id="customerEmail">
                                <label class="form-label">Select Type * </label>
                                <select class="form-select" id="customerType">
                                    <option value="1" selected>Customer</option>
                                    <option value="2">Supplier</option>
                                    <option value="3">Staff</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal"
                    aria-label="Close">Close</button>
                <button onclick="SaveCustomer()" id="save-btn" class="btn btn-sm  btn-success">Save</button>
            </div>
        </div>
    </div>
</div>


<script>
    async function SaveCustomer() {

        let customerName = document.getElementById('customerName').value;
        let customerEmail = document.getElementById('customerEmail').value;
        let customerMobile = document.getElementById('customerMobile').value;
        let customerAddress = document.getElementById('customerAddress').value;
        let customerType = document.getElementById('customerType').value;

        let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (customerName.length === 0) {
            errorToast("Name Required");
        } else if (customerAddress.length === 0) {
            errorToast("Address Required");
        } else if (customerEmail.length !== 0 && !emailRegex.test(customerEmail)) {
            errorToast('Enter Valid Email');
        } else if (customerMobile.length === 0) {
            errorToast("Mobile number Required");
        } else {
            document.getElementById('modal-close').click();
            showLoader();

            if (customerEmail.length === 0) {
                customerEmail = "N/A";
            }

            try {
                const res = await axios.post('/create-customer', {
                    name: customerName,
                    email: customerEmail,
                    mobile: customerMobile,
                    address: customerAddress,
                    type : customerType
                });

                hideLoader();
                document.getElementById('modal-close').click();

                successToast(res.data['message']);
                document.getElementById('save-form').reset();
                await getCustomerList();
            } catch (error) {
                errorToast('Customer creation failed');
            }

        }
    }
</script>
