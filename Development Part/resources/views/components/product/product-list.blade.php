<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card px-5 py-5">
                <div class="row justify-content-between ">
                    <div class="align-items-center col">
                        <h4>Product</h4>
                    </div>
                    <div class="align-items-center col">
                        <button data-bs-toggle="modal" data-bs-target="#create-modal"
                            class="float-end btn m-0 btn-sm bg-gradient-primary">Create</button>
                    </div>
                </div>
                <hr class="bg-dark" />
                <table class="table text-dark" id="tableData">
                    <thead>
                        <tr class="bg-light">
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Unit</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tableList" style="color:black">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script>
    const getProductList = async () => {
        showLoader();
        try {
            const res = await axios.get('/product-list');
            showData(res['data']['data'])
            hideLoader();
        } catch (error) {
            errorToast('Something went wrong');
            hideLoader();
        }

    }
    getProductList();

    const showData = (data) => {
        const tableList = $('#tableList');
        const tableData = $('#tableData');

        //aboding data repeating
        tableData.DataTable().destroy();
        tableList.empty();

        // Render Rows
        data.map((item, index) => {
            tableList.append(`<tr>
                    <td>${item['id']}</td>
                    <td><a href='${item['details_url']}' target="_blank"><img class="w-75 h-auto" alt="" src="${item['img_url']}"></a></td>
                    <td>${item['name']}</td>
                    <td>`+ item.category.name +`</td>
                    <td>${item['price']}</td>
                    <td>${item['unit']}</td>
                    <td>
                        <button data-path="${item['img_url']}" data-id="${item['id']}" class="btn editBtn btn-sm bg-gradient-info">Edit</button>
                        <button data-path="${item['img_url']}" data-id="${item['id']}" class="btn deleteBtn btn-sm bg-gradient-danger">Delete</button>
                    </td>
                 </tr>`)
        })

        // Edit Btn Handler
        $('.editBtn').on('click', async function() {
            let id = $(this).data('id');
            let filePath = $(this).data('path');
            await FillUpUpdateForm(id, filePath)
            $("#update-modal").modal('show');
        })

        // Delete Btn Handler
        $('.deleteBtn').on('click', function() {
            let id = $(this).data('id');
            let path = $(this).data('path');

            $("#delete-modal").modal('show');
            $("#deleteID").val(id);
            $("#deleteFilePath").val(path)

        })

        // Initalizing JQuery Data table 
        new DataTable('#tableData', {
            order: [
                [0, 'dsc']
            ],
            lengthMenu: [30, 50, 75, 100],
            columns: [null, { width: '20%' }, null, null, null, null, null]
        });


    }
</script>
