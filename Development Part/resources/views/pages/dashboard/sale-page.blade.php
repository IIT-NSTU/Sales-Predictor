@extends('layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-lg-6 p-2">
                <div class="shadow-sm h-100 bg-white rounded-3 p-3">
                    <div class="row">
                        <div class="col-8 text-dark">
                            <span class="text-bold">BILLED TO </span>
                            <p class="text-s mx-0 my-1">User ID: <span id="CId"></span></p>
                            <p class="text-s mx-0 my-1">Name: <span id="CName"></span> </p>
                            <p class="text-s mx-0 my-1">Mobile: <span id="CMobile"></span></p>
                            <p class="text-s mx-0 my-1">Address: <span id="CAddress"></span></p>
                        </div>
                        <div class="col-4">
                            <img class="w-40" id="logo" src="">
                            <p class="text-bold mx-0 my-1 text-dark">Invoice </p>
                            <p class="text-s mx-0 my-1">Date: 
                                <input id="date" class="" type="text" value="{{ date('Y-m-d h:i:s A') }}" />
                            </p>
                        </div>
                    </div>
                    <hr class="mx-0 my-2 p-0 bg-secondary" />

                    <div class="row">
                        <div class="col-12">
                            <table class="table w-100" style="color:black" id="invoiceTable">
                                <thead class="w-100">
                                    <tr class="text-s">
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
                            <p class="text-bold text-s my-3 text-dark"> TOTAL: <span id="total"></span></p>
        
                            <span class="text-bold text-s text-dark">DISCOUNT:</span>        
                            <div class="d-flex">
                                <input min="0" type="number"
                                onchange="calculateGrandTotal()" class="form-control mx-auto w-100 me-2 text-l" id="discount" />
                                
                                <select class="form-select text-xs w-40" id="discountType" onchange="calculateGrandTotal()">
                                    <option value="1" selected>Percentage (%)</option>
                                    <option value="2">Amount (BDT)</option>
                                </select>
                            </div> 

                            <p class="text-bold text-s my-3 text-dark"> DISCOUNT AMOUNT:
                                <span id="discountAmount"></span>
                            </p>

                            <span class="text-bold text-s text-dark">PAYABLE:</span>
                            <input min="0" type="number" 
                            onchange="updateDiscount()" class="form-control w-70 me-2" id="payable" /> 


                            <span class="text-bold text-s text-dark">PAID:</span>
                            <input min="0" type="number" 
                            onchange="calculateGrandTotal()" class="form-control w-70 me-2" id="paid" /> 

                            <p class="text-bold text-s my-3 text-dark"> DUE:
                                <span id="due"></span>
                            </p>

                            <div class="d-flex mt-3">
                                <div class="form-check me-3">
                                    <input class="form-check-input" name="invoiceType" type="radio" id="invoiceTypeSale" onchange="setContactList()" checked>
                                    <label for="invoiceTypeSale"> Sale </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="invoiceType" type="radio" onchange="setContactList()" id="invoiceTypePurchase" >
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
                                <tr class="text-s">
                                    <td>Product</td>
                                    <td style="display:none">Category</td>
                                    <td style="text-align:right">Quantity</td>
                                    <td style="text-align:right">Pick</td>
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
                                <tr class="text-s">
                                    <td id="customerLabel"></td>
                                    <td>Mobile</td>
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

    <div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
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
                                    <input type="text" class="form-control" id="PName" disabled>
                                    <label class="form-label">Product Price *</label>
                                    <input type="text" class="form-control" id="PPrice">
                                    <label class="form-label" id="PQtyLabel">Product Qty *</label>
                                    <input type="text" class="form-control" id="PQty">
                                    <input type="text" class="form-control d-none" id="PAcQty">
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
            await CustomerList(1);
            await ProductList();
            await setLogo();
            hideLoader();
        })()

        let InvoiceItemList = [];

        const handleCreateInvoice = async () => {
            const customerId = document.getElementById('CId').innerText;
            const total = document.getElementById('total').innerText;
            const discount = document.getElementById('discount').value;
            const payable = document.getElementById('payable').value;
            const paid = document.getElementById('paid').value;
            const due = document.getElementById('due').innerText;
            const date = document.getElementById('date').value;

            if (customerId.length === 0) {
                errorToast('Customer required')
            } else if (InvoiceItemList.length === 0) {
                errorToast('Product required')
            } else if (discount.length === 0) {
                errorToast('Discount required')
            } else if (parseFloat(discount) < 0) {
                errorToast('Please enter positive discount.')
            } else if (paid.length === 0) {
                errorToast('Paid amount required')
            } else if (payable.length === 0) {
                errorToast('Payable amount required')
            } else if (parseFloat(payable) < 0) {
                errorToast('Please enter positive payable amount.')
            } else if (parseFloat(paid) < 0) {
                errorToast('Please enter positive paid amount.')
            } else if (parseFloat(due) < 0) {
                errorToast('Due can not be negative.')
            } else {
                showLoader();
                try {
                    const purchaseRadio = document.getElementById('invoiceTypePurchase');
                    let type = "s"
                    if (purchaseRadio.checked) {
                        type = "p"
                    }
                    const res = await axios.post('/create-invoice', {
                        type:type,
                        total: total,
                        payable: payable,
                        discount: discount,
                        paid: paid,
                        due: due,
                        date: date,
                        customer_id: customerId,
                        products: InvoiceItemList
                    });
                    hideLoader();
                    successToast(res['data']['message']);
                    window.location.replace("/invoiceList")
                } catch (error) {
                    hideLoader();
                    errorToast('Invoice creation failed');
                }
            }
        }

        function setContactList() {
            const saleRadio = document.getElementById('invoiceTypeSale');
            const purchaseRadio = document.getElementById('invoiceTypePurchase');

            if (saleRadio.checked) {
                CustomerList(1);
            } else if (purchaseRadio.checked) {
                CustomerList(2);
            }

            $("#CName").text("");
            $("#CMobile").text("");
            $("#CAddress").text("");
            $("#CId").text("");
        }

        function ShowInvoiceItem() {

            let invoiceList = $('#invoiceList');

            invoiceList.empty();

            InvoiceItemList.forEach(function(item, index) {
                let row = `<tr class="text-s">
                        <td>${item['product_name']}</td>
                        <td>${item['quantity']}</td>
                        <td>${item['sale_price']}</td>
                        <td><a data-index="${index}" class="btn remove text-xs px-2 py-1  btn-sm m-0">Remove</a></td>
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

        function updateDiscount() {
            const payable = document.getElementById('payable').value;
            const total = document.getElementById('total').innerText;
            if (payable && total) {
                document.getElementById('discountAmount').innerText = total - payable;
                document.getElementById('discount').value = total - payable;
                document.getElementById('discountType').value = 2;
                calculateGrandTotal();
            }
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
            document.getElementById('payable').value = Payable;
            if( !isNaN(Due) ) {
                document.getElementById('due').innerText = Due;
            }
            if( !isNaN(discountAmount) ) {
                document.getElementById('discountAmount').innerText = discountAmount;
            }
        }


        function add() {
            let PId = document.getElementById('PId').value;
            let PName = document.getElementById('PName').value;
            let PPrice = document.getElementById('PPrice').value;
            let PQty = parseInt(document.getElementById('PQty').value);
            let PAcQty = document.getElementById('PAcQty').value;
            let PTotalPrice = (parseFloat(PPrice) * parseFloat(PQty)).toFixed(2);
            const purchaseRadio = document.getElementById('invoiceTypePurchase');
            if (PId.length === 0) {
                errorToast("Product ID Required");
            } else if (PName.length === 0) {
                errorToast("Product Name Required");
            } else if (PPrice.length === 0) {
                errorToast("Product Price Required");
            } else if (PQty.length === 0) {
                errorToast("Product Quantity Required");
            } else if (PQty <= 0) {
                errorToast("Product Quantity Can Not Be 0 or Negative.");
            } else {
                let totalItem = 0;
                InvoiceItemList.forEach(function(item, index) {
                    if (item.id === PId) {
                        totalItem += parseInt(item.quantity); 
                    }
                })

                if (purchaseRadio.checked || PAcQty >= (totalItem + PQty)) {
                    let item = {
                    id: PId,
                    product_name: PName,
                    quantity: PQty,
                    sale_price: PTotalPrice
                    };

                    InvoiceItemList.push(item);

                    $('#create-modal').modal('hide')
                    ShowInvoiceItem();
                } else {
                    errorToast("Sorry! You do not have " + (totalItem + PQty) + " units of " + PName);
                }
            }
        }


        function addModal(id, name, price, qty) {
            document.getElementById('PId').value = id
            document.getElementById('PName').value = name
            document.getElementById('PPrice').value = price
            document.getElementById('PAcQty').value = qty
            $('#create-modal').modal('show')
        }


        async function CustomerList(type) {
            if (type == 1) {
                $('#customerLabel').text('Customer');
            } else {
                $('#customerLabel').text('Supplier');
            }

            let res = await axios.get("/customersbytype/"+type);
            let customerList = $("#customerList");
            let customerTable = $("#customerTable");
            customerTable.DataTable().destroy();
            customerList.empty();

            res.data.forEach(function(item, index) {
                let row = `<tr class="text-s">
                        <td style="white-space: normal">${item['name']} (${item['address']}) </td>
                        <td style="white-space: normal">${item['mobile']}</td>
                        <td><a data-name="${item['name']}" data-mobile="${item['mobile']}" data-address="${item['address']}" data-id="${item['id']}" class="btn btn-outline-dark addCustomer  text-xs px-2 py-1  btn-sm m-0">Add</a></td>
                     </tr>`
                customerList.append(row)
            })


            $('.addCustomer').on('click', async function() {

                let CName = $(this).data('name');
                let CMobile = $(this).data('mobile');
                let CAddress = $(this).data('address');
                let CId = $(this).data('id');

                $("#CName").text(CName);
                $("#CMobile").text(CMobile);
                $("#CAddress").text(CAddress);
                $("#CId").text(CId);

            })


            new DataTable('#customerTable', {
                order: [
                    [0, 'asc']
                ],
                lengthMenu: [5, 10, 15, 20, 30, 50, 100],
            });
        }


        async function ProductList() {
            let res = await axios.get("/product-list-sale");
            let productList = $("#productList");
            let productTable = $("#productTable");
            productTable.DataTable().destroy();
            productList.empty();

            res.data.forEach(function(item, index) {
                if (item.category.active == 1) {
                let row = `<tr class="text-s">
                        <td><a target="_blank" href="${item['details_url']}"><img class="w-10 zoom" src="${item['img_url']}"/> ${item['name']} (${item['price']} BDT)</a></td>
                        <td style="display:none">` + item.category.name + `</td>
                        <td style="vertical-align: middle; text-align:right">${item['unit']}</td>
                        <td style="vertical-align: middle; text-align:right">
                            <a data-name="${item['name']}" data-price="${item['price']}" data-qty="${item['unit']}" data-id="${item['id']}" class="btn btn-outline-dark text-xs px-2 py-1 addProduct  btn-sm m-0">Add</a>
                        </td>
                     </tr>`
                productList.append(row)
                }
            })


            $('.addProduct').on('click', async function() {
                let PName = $(this).data('name');
                let PPrice = $(this).data('price');
                let PId = $(this).data('id');
                let PQty = $(this).data('qty');

                addModal(PId, PName, PPrice, PQty)

            })


            new DataTable('#productTable', {
                order: [
                    [0, 'desc']
                ],
                lengthMenu: [5, 10, 15, 20, 30, 50, 100],
            });
        }

        async function setLogo() {
            const res = await axios.get('/user-profile-details');
            const user = res['data']['data'];
            const logo = document.getElementById('logo');
            logo.src = user['logo_url'];
        }
    </script>
@endsection
