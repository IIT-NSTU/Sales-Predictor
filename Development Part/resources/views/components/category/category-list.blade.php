<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card px-5 py-5">
                <div class="row justify-content-between ">
                    <div class="align-items-center col">
                        <h4>Category</h4>
                    </div>
                    <div class="align-items-center col">
                        <button data-bs-toggle="modal" data-bs-target="#create-modal"
                            class="float-end btn m-0 btn-sm bg-gradient-primary">Create</button>
                    </div>
                </div>
                <hr class="bg-dark " />
                <table class="table text-dark" id="tableData">
                    <thead>
                        <tr class="bg-light">
                            <th>No</th>
                            <th>Category</th>
                            <th>Type</th>
                            <th>Count</th>
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
    const getCategoryList = async () => {
        showLoader();
        try {
            let res = await axios.get('/category-list');
            showData(res['data']['data'])
            hideLoader();
        } catch (error) {
            errorToast('Something went wrong');
            hideLoader();
        }

    }
    getCategoryList();

    const showData = (data) => {
        const tableList = $('#tableList');
        const tableData = $('#tableData');

        //aboding data repeating
        tableData.DataTable().destroy();
        tableList.empty();

        // Render Rows
        data.map((item, index) => {
            let type = "Product";
            if (item.type == 2) {
                type = "Expense";
            }
            tableList.append(`<tr>
                <td>${index+1} </td>
                <td>${item['name']} </td>
                <td>${type} </td>
                <td>${item['products_count']} </td>
                 <td>
                    <button data-id = "${item['id']}" data-name = "${item['name']}" data-type = "${item['type']}" class = "btn editBtn btn-sm bg-gradient-info">Edit</button>
                    <button data-id = "${item['id']}"  class ="btn deleteBtn btn-sm bg-gradient-danger">Delete</button>
                     </td>
                </tr>`)
        })

        // Edit Btn Handler
        $('.editBtn').on('click', function() {
            let id = $(this).data('id');
            let name = $(this).data('name');
            let type = $(this).data('type');
            $('#update-modal').modal('show');
            $('#updateID').val(id);
            $('#categoryNameUpdate').val(name);
            if (type == 1) {
                $("#productTypeUpdate").prop("checked", true); 
            } else {
                $("#expenseTypeUpdate").prop("checked", true); 
            }
        })

        // Delete Btn Handler
        $('.deleteBtn').on('click', function() {
            let id = $(this).data('id');
            $('#delete-modal').modal('show');
            $('#deleteID').val(id);

        })

        // Initalizing JQuery Data table 
        new DataTable('#tableData', {
            order: [
                [0, 'asc']
            ],
            lengthMenu: [10, 20, 30, 40]
        });

    }
</script>
