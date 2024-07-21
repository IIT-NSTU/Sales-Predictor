<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card px-5 py-5">
                <div class="row justify-content-between ">
                    <div class="align-items-center col">
                        <h4>Expense</h4>
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
                            <th>Amount</th>
                            <th>Comment</th>
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
    getExpenseList();
    async function getExpenseList() {
        showLoader();
        try {
            const res = await axios.get('/expense-list');
            hideLoader();

            const tableList = $('#tableList');
            const tableData = $('#tableData');

            tableData.DataTable().destroy();
            tableList.empty();

            res.data.forEach(function(item, index) {
                const row = `<tr>
                <td>${index+1} </td>
                <td>${item.category.name} </td>
                <td>${item['amount']} </td>
                <td style="white-space: normal">${item['comment']} </td>
                <td>
                    <button data-id = "${item['id']}" class="btn editBtn btn-sm bg-gradient-info" >Edit</button>
                    <button data-id = "${item['id']}" class="btn deleteBtn btn-sm bg-gradient-danger">Delete</button> </td>
                </tr>`
                tableList.append(row)
            })

            $('.editBtn').on('click', async function() {
                const id = $(this).data('id');
                await FillUpUpdateForm(id);
                $("#update-modal").modal('show');
            })

            $('.deleteBtn').on('click', function() {
                const id = $(this).data('id');
                $('#delete-modal').modal('show');
                $('#deleteID').val(id);
            })

        } catch (error) {
            hideLoader();
            errorToast('Something went wrong');
        }

        new DataTable('#tableData', {
            order: [
                [0, 'asc']
            ],
            lengthMenu: [5, 20, 30, 40]
        });
    }
</script>
