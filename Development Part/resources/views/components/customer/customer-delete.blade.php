<div class="modal animated zoomIn" id="delete-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h3 class=" mt-3 text-warning">Delete !</h3>
                <p class="mb-3" style="color:black">Are you sure you want to delete this contact?</p>
                <input class="d-none" id="deleteID" />
            </div>
            <div class="modal-footer justify-content-end">
                <div>
                    <button type="button" id="delete-modal-close" class="btn shadow-sm btn-secondary"
                        data-bs-dismiss="modal">Cancel</button>
                    <button onclick="itemDelete()" type="button" id="confirmDelete"
                        class="btn shadow-sm btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    async function itemDelete() {
        const id = document.getElementById('deleteID').value;
        document.getElementById('delete-modal-close').click();

        showLoader();
        try {
            const res = await axios.post("/delete-customer", {
                id: id
            })
            hideLoader();
            successToast(res.data['message']);
            await getCustomerList();
        } catch (error) {
            errorToast('Customer deleting failed');
        }
    }
</script>
