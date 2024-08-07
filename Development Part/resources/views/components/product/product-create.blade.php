<div class="modal" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Product</h5>
            </div>
            <div class="modal-body">
                <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">

                                <label class="form-label">Category</label>
                                <select type="text" class="form-control form-select" id="productCategory">
                                    <option value="">Select Category</option>
                                </select>

                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" id="productName">
                                <label class="form-label">Price</label>
                                <input type="text" class="form-control" id="productPrice">
                                <label class="form-label">Unit</label>
                                <input type="text" class="form-control" id="productUnit">

                                <br />
                                <label for="productImg">
                                    <img class="w-15 rounded-sm" id="previewImg"
                                        src="{{ asset('images/default.jpg') }}" />
                                </label>
                                <br />

                                <label class="form-label">Image</label>
                                <input accept="image/jpeg,image/jpg, image/png, image/webp" oninput="handleImgPreviw(event)"
                                    type="file" class="form-control" id="productImg">
                                <label class="form-label mt-3">Product Details Page Link</label>
                                    <input type="text" class="form-control" id="productDetails">    
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
    const fillCategoryDropDown = async () => {
        const categoryDropdown = document.getElementById('productCategory');

        try {
            const res = await axios.get('/categorybytype/1');
            res.data.map(category => {
                categoryDropdown.innerHTML += (
                    `<option value="${category['id']}">
                        ${category['name']}
                    </option>`);
            })
        } catch (error) {
            console.log(error);
        }
    }
    fillCategoryDropDown();

    const handleSave = async () => {

        const productCategory = document.getElementById('productCategory').value;
        const productName = document.getElementById('productName').value;
        const productPrice = document.getElementById('productPrice').value;
        const productUnit = document.getElementById('productUnit').value;
        const productImg = document.getElementById('productImg').files[0];
        const productDetails = document.getElementById('productDetails').value;

        // Validation
        if (productCategory.length === 0) {
            errorToast("Product category selection required")
        } else if (productName.length === 0) {
            errorToast("Product name is required")
        } else if (productPrice.length === 0) {
            errorToast("Product price is required")
        } else if (productUnit.length === 0) {
            errorToast("Product unit is required")
        } else {

            // Close Model
            document.getElementById('modal-close').click();

            // Genarate Form Data
            const formData = new FormData();
            if (productImg) {
                formData.append('img', productImg);
            }
            formData.append('name', productName);
            formData.append('details', productDetails);
            formData.append('price', productPrice);
            formData.append('unit', productUnit);
            formData.append('category_id', productCategory);

            const config = {
                headers: {
                    'content-type': 'multipart/form-data'
                }
            };
            showLoader();
            try {
                const res = await axios.post('/create-product', formData, config);
                // Reset Form
                document.getElementById("save-form").reset();
                document.getElementById("previewImg").src = "images/default.jpg";
                hideLoader();
                // Refresh Table
                await getProductList();
                successToast(res['data']['message']);
            } catch (error) {
                hideLoader();
                errorToast(error.response.data.message);
            }
        }
    }

    const handleImgPreviw = (e) => {
        const previwImg = document.getElementById('previewImg');
        const imgUrl = window.URL.createObjectURL(e.target.files[0]);
        previwImg.src = imgUrl;
    }
</script>
