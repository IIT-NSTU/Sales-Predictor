<div class="container-fluid">
    <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="card px-5 py-5">
            <div class="row justify-content-between ">
                <div class="align-items-center col">
                    <h5>Invoices</h5>
                </div>
            </div>
            <hr class="bg-dark "/>
            <table class="table text-dark" id="tableData">
                <thead>
                <tr class="bg-light">
                    <th>No</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Total</th>
                    <th>Discount</th>
                    <th>Payable</th>
                    <th>Paid</th>
                    <th>Due</th>
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

getList();


async function getList() {


    showLoader();
    let res=await axios.get("/invoice-list");
    hideLoader();

    let tableList=$("#tableList");
    let tableData=$("#tableData");

    tableData.DataTable().destroy();
    tableList.empty();

    res.data?.data.forEach(function (item,index) {
        let row=`<tr>
                    <td>${index+1}</td>
                    <td>${item['customer']['name']}</td>
                    <td>${item['customer']['mobile']}</td>
                    <td>${item['total']}</td>
                    <td>${item['discount']}</td>
                    <td>${item['payable']}</td>
                    <td>${item['paid']}</td>
                    <td>${item['due']}</td>
                    <td>
                        <button data-id="${item['id']}" data-cus="${item['customer']['id']}" class="viewBtn btn btn-sm bg-gradient-info">View</button>
                        <button data-id="${item['id']}" data-cus="${item['customer']['id']}" class="deleteBtn btn btn-sm bg-gradient-danger">Delete</button>
                    </td>
                 </tr>`
        tableList.append(row)
    })

    $('.viewBtn').on('click', async function () {
        let inv_id= $(this).data('id');
        let cus_id= $(this).data('cus');
         await InvoiceDetails(cus_id,inv_id)
    })

    $('.deleteBtn').on('click',function () {
        let id= $(this).data('id');
        document.getElementById('deleteID').value=id;
        $("#delete-modal").modal('show');
    })

    new DataTable('#tableData',{
        order:[[0,'desc']],
        lengthMenu:[5,10,15,20,30]
    });

}


</script>

