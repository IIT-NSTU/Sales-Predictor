<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Customer</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Name *</label>
                                <input type="text" class="form-control" id="customerNameUpdate">
                                <label class="form-label">Address *</label>
                                <input type="text" class="form-control" id="customerAddressUpdate">
                                <label class="form-label">Mobile Numbers (comma separated) *</label>
                                <input type="text" class="form-control" id="customerMobileUpdate">
                                <label class="form-label">Email *</label>
                                <input type="text" class="form-control" id="customerEmailUpdate">
                                <label class="form-label">Select Type * </label>
                                <select class="form-select" id="customerTypeUpdate">
                                    <option value="1" selected>Customer</option>
                                    <option value="2">Supplier</option>
                                    <option value="3">Staff</option>
                                </select>
                                <input type="text" class="d-none" id="updateID">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal"
                    aria-label="Close">Close</button>
                <button onclick="Update()" id="update-btn" class="btn btn-sm  btn-success">Update</button>
            </div>
        </div>
    </div>
</div>


<script>
    async function FillUpUpdateForm(id) {
        document.getElementById('updateID').value = id;
        showLoader();
        const res = await axios.get(`/customers/${id}`)
        hideLoader();
        document.getElementById('customerNameUpdate').value = res.data['name'];
        document.getElementById('customerAddressUpdate').value = res.data['address'];
        document.getElementById('customerEmailUpdate').value = res.data['email'];
        document.getElementById('customerMobileUpdate').value = res.data['mobile'];
        document.getElementById('customerTypeUpdate').value = res.data['type'];
    }



    async function Update() {

        const customerName = document.getElementById('customerNameUpdate').value;
        const customerEmail = document.getElementById('customerEmailUpdate').value;
        const customerMobile = document.getElementById('customerMobileUpdate').value;
        const customerAddress = document.getElementById('customerAddressUpdate').value;
        const customerType = document.getElementById('customerTypeUpdate').value;

        const updateID = document.getElementById('updateID').value;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;


        if (customerName.length === 0) {
            errorToast("Name Required !")
        } else if (customerAddress.length === 0) {
            errorToast("Address Required");
        } else if (customerEmail.length !== 0 && customerEmail !== "N/A" && !emailRegex.test(customerEmail)) {
            errorToast('Enter Valid Email');
        } else if (customerMobile.length === 0) {
            errorToast("Mobile Required !")
        } else {

            document.getElementById('update-modal-close').click();

            showLoader();

            if (customerEmail.length === 0) {
                customerEmail = "N/A";
            }

            try {
                const res = await axios.post("/update-customer", {
                    name: customerName,
                    email: customerEmail,
                    mobile: customerMobile,
                    address: customerAddress,
                    type : customerType,
                    id: updateID
                })

                hideLoader();
                successToast(res.data['message']);
                document.getElementById("update-form").reset();

                await getCustomerList();
            } catch (error) {
                errorToast('Customer updating failed');
            }


        }
    }
</script>
