<!-- Modal -->
<div class="modal animated zoomIn" id="details-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Invoice</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="invoice" class="modal-body p-3">
                <div class="container-fluid">
                    <br />
                    <div class="row">
                        <div class="col-8">
                            <span class="text-bold text-dark">BILLED TO </span>
                            <p class="text-xs mx-0 my-1 text-dark">Name: <span id="CName"></span> </p>
                            <p class="text-xs mx-0 my-1 text-dark">Name: <span id="CMobile"></span> </p>
                            <p class="text-xs mx-0 my-1 text-dark">Email: <span id="CEmail"></span></p>
                            <p class="text-xs mx-0 my-1 text-dark">Email: <span id="CAddress"></span></p>
                            <p class="text-xs mx-0 my-1 text-dark">User ID: <span id="CId"></span> </p>
                        </div>
                        <div class="col-4">
                            <img class="w-40" src="{{ 'images/logo3.png' }}">
                            <p class="text-bold mx-0 my-1 text-dark">Invoice </p>
                            <p class="text-xs mx-0 my-1 text-dark">Date: {{ date('Y-m-d') }} </p>
                        </div>
                    </div>
                    <hr class="mx-0 my-2 p-0 bg-secondary" />
                    <div class="row">
                        <div class="col-12">
                            <table class="table w-100" id="invoiceTable">
                                <thead class="w-100 text-dark">
                                    <tr class="text-xs text-bold">
                                        <td>Product Name</td>
                                        <td>Qty</td>
                                        <td>Total</td>
                                    </tr>
                                </thead>
                                <tbody class="w-100" id="invoiceList" style="color:black">
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-primary" data-bs-dismiss="modal">Close</button>
                <button onclick="PrintPage()" class="btn bg-gradient-success">Print</button>
            </div>
        </div>
    </div>
</div>


<script>
    async function InvoiceDetails(cus_id, inv_id) {

        showLoader()
        try {
            let res = await axios.post("/invoice-details", {
                customer_id: cus_id,
                invoice_id: inv_id
            })
            hideLoader();

            document.getElementById('CName').innerText = res.data?.data['customer']['name']
            document.getElementById('CId').innerText = res.data?.data['customer']['id']
            document.getElementById('CEmail').innerText = res.data?.data['customer']['email']
            document.getElementById('CMobile').innerText = res.data?.data['customer']['mobile']
            document.getElementById('CAddress').innerText = res.data?.data['customer']['address']

            let discountType = " (%)";
            let total = parseFloat(res.data?.data['invoice']['total']);
            let discount = parseFloat(res.data?.data['invoice']['discount']);
            let payable = parseFloat(res.data?.data['invoice']['payable']);
            let paid = parseFloat(res.data?.data['invoice']['paid']);
            let due = parseFloat(res.data?.data['invoice']['due']);

            if ((total - discount) == payable) {
                discountType = " (BDT)";
            }

            let invoiceList = $('#invoiceList');

            invoiceList.empty();

            res.data?.data['products'].forEach(function(item, index) {
                let row = `<tr class="text-xs">
                        <td>${item.product.name}</td>
                        <td>${item['quantity']}</td>
                        <td>${item['sale_price']}</td>
                      </tr>`
                invoiceList.append(row)
            });

            let footer = `
                            <tr class="text-bold text-xs text-dark">
                                <td></td>
                                <td> Total: </td>
                                <td>${total}</td>
                            </tr>
                            <tr class="text-bold text-xs text-dark">
                                <td></td>
                                <td> Discount: </td>
                                <td>${discount + discountType}</td>
                            </tr>
                            <tr class="text-bold text-xs text-dark">
                                <td></td>
                                <td> Payable: </td>
                                <td>${payable}</td>
                            </tr>
                            <tr class="text-bold text-xs text-dark">
                                <td></td>
                                <td> Paid: </td>
                                <td>${paid}</td>
                            </tr>
                            <tr class="text-bold text-xs text-dark">
                                <td></td>
                                <td> Due: </td>
                                <td>${due}</td>
                            </tr>`;

            invoiceList.append(footer);                

            hideLoader();
            $("#details-modal").modal('show')
        } catch (error) {
            hideLoader();
            errorToast('Something went wrong');
        }

    }

    function PrintPage() {
        let printContents = document.getElementById('invoice').innerHTML;
        let originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        
        document.body.innerHTML = originalContents;
        setTimeout(function() {
            location.reload();
        }, 1000);
    }
</script>
