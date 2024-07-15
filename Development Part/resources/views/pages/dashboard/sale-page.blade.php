@extends('layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-lg-6 p-2">
                <div class="shadow-sm h-100 bg-white rounded-3 p-3">
                    <div class="row">
                        <div class="col-8">
                            <span class="text-bold text-dark">BILLED TO </span>
                            <p class="text-xs mx-0 my-1">Name: <span id="CName"></span> </p>
                            <p class="text-xs mx-0 my-1">Email: <span id="CEmail"></span></p>
                            <p class="text-xs mx-0 my-1">User ID: <span id="CId"></span></p>
                        </div>
                        <div class="col-4">
                            <img class="w-40" src="{{ 'images/logo3.png' }}">
                            <p class="text-bold mx-0 my-1 text-dark">Invoice </p>
                            <p class="text-xs mx-0 my-1">Date: {{ date('Y-m-d') }} </p>
                        </div>
                    </div>
                    <hr class="mx-0 my-2 p-0 bg-secondary" />

                    <div class="row">
                        <div class="col-12">
                            <table class="table w-100" style="color:black" id="invoiceTable">
                                <thead class="w-100">
                                    <tr class="text-xs">
                                        <td>Name</td>
                                        <td>Qty</td>
                                        <td>Total</td>
                                        <td>Remove</td>
                                    </tr>
                                </thead>
                                <tbody class="w-100" id="invoiceList">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr class="mx-0 my-2 p-0 bg-secondary" />
                    <div class="row">
                        <div class="col-12">
                            <p class="text-bold text-xs my-3 text-dark"> TOTAL: <i class="bi bi-currency-dollar"></i> <span
                                    id="total"></span></p>
        
                            <span class="text-bold text-xs text-dark">DISCOUNT:</span>        
                            <div class="d-flex">
                                <input min="0" type="number"
                                onchange="calculateGrandTotal()" class="form-control mx-auto w-100 form-control-sm me-2" id="discount" />
                                
                                <select class="form-select text-xs w-40" id="discountType" onchange="calculateGrandTotal()">
                                    <option value="1" selected>Percentage (%)</option>
                                    <option value="2">Amount (BDT)</option>
                                </select>
                            </div> 

                            <p class="text-bold text-xs my-3 text-dark"> DISCOUNT AMOUNT: <i class="bi bi-currency-dollar"></i>
                                <span id="discountAmount"></span>
                            </p>

                            <p class="text-bold text-xs my-3 text-dark"> PAYABLE: <i class="bi bi-currency-dollar"></i>
                                <span id="payable"></span>
                            </p>


                            <span class="text-bold text-xs text-dark">PAID:</span>
                            <input min="0" type="number" 
                            onchange="calculateGrandTotal()" class="form-control w-70 form-control-sm me-2" id="paid" /> 

                            <p class="text-bold text-xs my-3 text-dark"> DUE: <i class="bi bi-currency-dollar"></i>
                                <span id="due"></span>
                            </p>

                            <div class="d-flex mt-3">
                                <div class="form-check me-3">
                                    <input class="form-check-input" name="invoiceType" type="radio" id="invoiceTypeSale" checked>
                                    <label for="invoiceTypeSale"> Sale </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="invoiceType" type="radio" id="invoiceTypePurchase" >
                                    <label for="invoiceTypePurchase"> Purchase </label>
                                </div>
                            </div>        
                            <p>
                                <button onclick="handleCreateInvoice()"
                                    class="btn btn-sm my-2 bg-gradient-primary w-40">Confirm</button>
                            </p>
                        </div>
                        <div class="col-12 p-2">

                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-6">
                <div class="p-2">
                    <div class="shadow-sm h-100 bg-white rounded-3 p-3">
                        <table class="table  w-100" style="color:black" id="productTable">
                            <thead class="w-100">
                                <tr class="text-xs">
                                    <td>Product</td>
                                    <td>Pick</td>
                                </tr>
                            </thead>
                            <tbody class="w-100" id="productList">

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="p-2">
                    <div class="shadow-sm h-100 bg-white rounded-3 p-3">
                        <table class="table table-sm w-100" style="color:black" id="customerTable">
                            <thead class="w-100">
                                <tr class="text-xs">
                                    <td>Customer</td>
                                    <td>Pick</td>
                                </tr>
                            </thead>
                            <tbody class="w-100" id="customerList">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Add Product</h6>
                </div>
                <div class="modal-body">
                    <form id="add-form">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 p-1">
                                    <label class="form-label d-none">Product ID *</label>
                                    <input type="text" class="form-control d-none" id="PId">
                                    <label class="form-label">Product Name *</label>
                                    <input type="text" class="form-control" id="PName">
                                    <label class="form-label">Product Price *</label>
                                    <input type="text" class="form-control" id="PPrice">
                                    <label class="form-label">Product Qty *</label>
                                    <input type="text" class="form-control" id="PQty">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="modal-close" class="btn btn-sm btn-danger" data-bs-dismiss="modal"
                        aria-label="Close">Close</button>
                    <button onclick="add()" id="save-btn" class="btn btn-sm   btn-success">Add</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        (async () => {
            showLoader();
            await CustomerList();
            await ProductList();
            hideLoader();
        })()

        let InvoiceItemList = [];

        const handleCreateInvoice = async () => {
            const customerId = document.getElementById('CId').innerText;
            const total = document.getElementById('total').innerText;
            const discount = document.getElementById('discount').value;
            const vat = document.getElementById('vat').innerText;
            const payable = document.getElementById('payable').innerText;

            if (customerId.length === 0) {
                errorToast('Customer required')
            } else if (InvoiceItemList.length === 0) {
                errorToast('Product required')
            } else if (discount.length === 0) {
                errorToast('Discount required')
            } else {
                showLoader();
                try {
                    const res = await axios.post('/create-invoice', {
                        total: total,
                        payable: payable,
                        discount: discount,
                        vat: vat,
                        customer_id: customerId,
                        products: InvoiceItemList
                    });
                    hideLoader();
                    successToast(res['data']['message']);
                } catch (error) {
                    hideLoader();
                    errorToast('Invoice creation failed');
                }
            }
        }

        function ShowInvoiceItem() {

            let invoiceList = $('#invoiceList');

            invoiceList.empty();

            InvoiceItemList.forEach(function(item, index) {
                let row = `<tr class="text-xs">
                        <td>${item['product_name']}</td>
                        <td>${item['quantity']}</td>
                        <td>${item['sale_price']}</td>
                        <td><a data-index="${index}" class="btn remove text-xxs px-2 py-1  btn-sm m-0">Remove</a></td>
                     </tr>`
                invoiceList.append(row)
            })

            calculateGrandTotal();

            $('.remove').on('click', async function() {
                let index = $(this).data('index');
                removeItem(index);
            })

        }

        function removeItem(index) {
            InvoiceItemList.splice(index, 1);
            ShowInvoiceItem()
        }

        function calculateGrandTotal() {
            let Total = 0;
            let Due = 0;
            let Payable = 0;
            let discountAmount = 0;

            InvoiceItemList.forEach((item, index) => {
                Total = Total + parseFloat(item['sale_price'])
            })

            const discountType = document.getElementById('discountType').value;
            const discount = document.getElementById('discount').value;
            const paid = document.getElementById('paid').value;

            if (discountType == 1) {
                discountAmount = ((Total * discount) / 100).toFixed(2);
            } else {
                discountAmount = parseFloat(discount);
            }

            Payable = (parseFloat(Total) - parseFloat(discountAmount)).toFixed(2);

            Due = (Payable - parseFloat(paid)).toFixed(2);
            
            document.getElementById('total').innerText = Total;
            document.getElementById('payable').innerText = Payable;
            document.getElementById('discountAmount').innerText = discountAmount;
            document.getElementById('due').innerText = Due.replace(/\d(?=(\d{3})+\.)/g, '$&,');
        }


        function add() {
            let PId = document.getElementById('PId').value;
            let PName = document.getElementById('PName').value;
            let PPrice = document.getElementById('PPrice').value;
            let PQty = document.getElementById('PQty').value;
            let PTotalPrice = (parseFloat(PPrice) * parseFloat(PQty)).toFixed(2);
            if (PId.length === 0) {
                errorToast("Product ID Required");
            } else if (PName.length === 0) {
                errorToast("Product Name Required");
            } else if (PPrice.length === 0) {
                errorToast("Product Price Required");
            } else if (PQty.length === 0) {
                errorToast("Product Quantity Required");
            } else {
                let item = {
                    id: PId,
                    product_name: PName,
                    quantity: PQty,
                    sale_price: PTotalPrice
                };
                InvoiceItemList.push(item);
                $('#create-modal').modal('hide')
                ShowInvoiceItem();
            }
        }


        function addModal(id, name, price) {
            document.getElementById('PId').value = id
            document.getElementById('PName').value = name
            document.getElementById('PPrice').value = price
            $('#create-modal').modal('show')
        }


        async function CustomerList() {
            let res = await axios.get("/customer-list");
            let customerList = $("#customerList");
            let customerTable = $("#customerTable");
            customerTable.DataTable().destroy();
            customerList.empty();

            res.data?.data.forEach(function(item, index) {
                let row = `<tr class="text-xs">
                        <td><i class="bi bi-person"></i> ${item['name']}</td>
                        <td><a data-name="${item['name']}" data-email="${item['email']}" data-id="${item['id']}" class="btn btn-outline-dark addCustomer  text-xxs px-2 py-1  btn-sm m-0">Add</a></td>
                     </tr>`
                customerList.append(row)
            })


            $('.addCustomer').on('click', async function() {

                let CName = $(this).data('name');
                let CEmail = $(this).data('email');
                let CId = $(this).data('id');

                $("#CName").text(CName)
                $("#CEmail").text(CEmail)
                $("#CId").text(CId)

            })


            new DataTable('#customerTable', {
                order: [
                    [0, 'desc']
                ],
                scrollCollapse: false,
                info: false,
                lengthChange: false
            });
        }


        async function ProductList() {
            let res = await axios.get("/product-list");
            let productList = $("#productList");
            let productTable = $("#productTable");
            productTable.DataTable().destroy();
            productList.empty();

            res.data.data?.forEach(function(item, index) {
                let row = `<tr class="text-xs">
                        <td><a target="_blank" href="${item['details_url']}"><img class="w-10" src="${item['img_url']}"/> ${item['name']} (${item['price']} BDT)</a></td>
                        <td><a data-name="${item['name']}" data-price="${item['price']}" data-id="${item['id']}" class="btn btn-outline-dark text-xxs px-2 py-1 addProduct  btn-sm m-0">Add</a></td>
                     </tr>`
                productList.append(row)
            })


            $('.addProduct').on('click', async function() {
                let PName = $(this).data('name');
                let PPrice = $(this).data('price');
                let PId = $(this).data('id');

                addModal(PId, PName, PPrice)

            })




            new DataTable('#productTable', {
                order: [
                    [0, 'desc']
                ],
                scrollCollapse: false,
                info: false,
                lengthChange: false
            });
        }
    </script>
@endsection
