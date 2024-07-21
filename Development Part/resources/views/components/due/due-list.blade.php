<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card px-5 py-5">
                <div class="row justify-content-between ">
                    <div class="align-items-center col">
                        <h4>Due</h4>
                    </div>
                </div>
                <hr class="bg-dark" />
                <table class="table text-dark" id="tableData">
                    <thead>
                        <tr class="bg-light">
                            <th>No</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Due Amount</th>
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
    const getDueList = async () => {
        showLoader();
        try {
            const res = await axios.get('/due-list');
            showData(res['data']['data'])
            hideLoader();
        } catch (error) {
            errorToast('Something went wrong');
            hideLoader();
        }

    }
    getDueList();

    const showData = (data) => {
        const tableList = $('#tableList');
        const tableData = $('#tableData');

        //aboding data repeating
        tableData.DataTable().destroy();
        tableList.empty();

        // Render Rows
        data.map((item, index) => {
            tableList.append(`<tr>
                   <td>${index+1}</td>
                    <td> ${item.customer.name} </td>
                    <td> ${item.customer.mobile} </td>
                    <td style="white-space: normal"> ${item.customer.address} </td>
                    <td> ${item.remaining_due} </td>
                    <td>
                        <button data-amount="${item.remaining_due}" data-cid="${item.customer.id}" data-id="${item['id']}" class="btn addDue btn-sm bg-gradient-success">Add</button>
                        <button data-id="${item['id']}" data-cus="${item.customer.id}" class="btn historyBtn btn-sm bg-gradient-info">History</button>
                    </td>
                 </tr>`)
        })

        // Initalizing JQuery Data table 
        new DataTable('#tableData', {
            order: [
                [4, 'dsc']
            ],
            lengthMenu: [5, 10, 15, 20, 30, 50, 100],
        });

        $('.addDue').on('click', async function() {
            let DId = $(this).data('id');
            let CId = $(this).data('cid');
            let DAmount = $(this).data('amount');
            addModal(DId, CId, DAmount);
        })

        $('.historyBtn').on('click', async function () {
        let inv_id= $(this).data('id');
        let cus_id= $(this).data('cus');
         await DueInvoiceDetails(cus_id,inv_id)
    })
    }

    function addModal(id, cid, amount) {
        document.getElementById('DId').value = id;
        document.getElementById('CId').value = cid;
        document.getElementById('DActAmount').value = amount;
        $('#create-modal').modal('show');
    }
</script>
