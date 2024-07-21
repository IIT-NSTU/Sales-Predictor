<!-- Modal -->
<div class="modal" id="details-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Due History</h1>
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
                            <p class="text-xs mx-0 my-1 text-dark">Address: <span id="CAddress"></span></p>
                            <p class="text-xs mx-0 my-1 text-dark">User ID: <span id="CDId"></span> </p>
                        </div>
                        <div class="col-4">
                            <img class="w-40" src="{{ 'images/logo3.png' }}">
                            <p class="text-bold mx-0 my-1 text-dark">Due Record</p>
                            <p class="text-xs mx-0 my-1 text-dark">Date: <span id="date"></span> </p>
                        </div>
                    </div>
                    <hr class="mx-0 my-2 p-0 bg-secondary" />
                    <div class="row">
                        <div class="col-12">
                            <table class="table w-100" id="dueInvoiceTable">
                                <thead class="w-100 text-dark">
                                    <tr class="text-xs text-bold">
                                        <td>Total Amount</td>
                                        <td>Discount</td>
                                        <td>Payable</td>
                                        <td>Paid</td>
                                        <td>Initial Due</td>
                                    </tr>
                                    <tr class="text-xs text-bold">
                                        <td id="total"></td>
                                        <td id="discount"></td>
                                        <td id="payable"></td>
                                        <td id="paid"></td>
                                        <td id="initial_due"></td>
                                    </tr>
                                </thead>
                                <tbody class="w-100" id="dueInvoiceList" style="color:black">
                                
                                </tbody>
                            </table>
                        </div>

                        <hr class="mx-0 my-5 p-0 bg-secondary" />
                        <div class="col-12 d-flex justify-content-center">
                            <table class="table w-75" id="dueTable">
                                <thead class="w-100 text-dark">
                                    <tr class="text-xs text-bold">
                                        <td>No</td>
                                        <td style="text-align:right">Date</td>
                                        <td style="text-align:right">Amount</td>
                                    </tr>
                                </thead>
                                <tbody class="w-100" id="dueList" style="color:black">
                                
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
    async function DueInvoiceDetails(cus_id, inv_id) {

        showLoader()
        try {
            let res = await axios.post("/due-invoice-details", {
                customer_id: cus_id,
                invoice_id: inv_id
            })
            hideLoader();

            document.getElementById('CName').innerText = res.data?.data['customer']['name'];
            document.getElementById('CDId').innerText = res.data?.data['customer']['id'];
            document.getElementById('CEmail').innerText = res.data?.data['customer']['email'];
            document.getElementById('CMobile').innerText = res.data?.data['customer']['mobile'];
            document.getElementById('CAddress').innerText = res.data?.data['customer']['address'];
            document.getElementById('date').innerText = res.data?.data['invoice']['date'];

            let discountType = " (%)";
            let total = parseFloat(res.data?.data['invoice']['total']);
            let discount = parseFloat(res.data?.data['invoice']['discount']);
            let payable = parseFloat(res.data?.data['invoice']['payable']);
            let paid = parseFloat(res.data?.data['invoice']['paid']);
            let initial_due = parseFloat(res.data?.data['invoice']['initial_due']);

            if ((total - discount) == payable) {
                discountType = " (BDT)";
            }

            document.getElementById('total').innerText = total;
            document.getElementById('discount').innerText = discount + discountType;
            document.getElementById('payable').innerText = payable;
            document.getElementById('paid').innerText = paid;
            document.getElementById('initial_due').innerText = initial_due;

            let dueList = $('#dueList');

            dueList.empty();
            let dueCount = 0;
            res.data?.data['dues'].forEach(function(item, index) {
                let row = `
                    <tr class="text-xs">
                        <td>${index+1}</td>
                        <td style="text-align:right">${item['date']}</td>
                        <td style="text-align:right">${item['amount']}</td>
                    </tr>`;
                dueList.append(row);
                dueCount += parseFloat(item['amount']);
            });

            let footer = `
                <tr>
                    <td></td>
                    <td style="text-align:right">Total</td>
                    <td style="text-align:right">${dueCount.toFixed(2)}</td>
                </tr>
                <tr>
                    <td></td>
                    <td style="text-align:right">Remaining</td>
                    <td style="text-align:right">${(payable - paid - dueCount).toFixed(2)}</td>    
                </tr>`;
            dueList.append(footer);

            hideLoader();
            $("#details-modal").modal('show')
        } catch (error) {
            hideLoader();
            errorToast('Something went wrong' + error);
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
