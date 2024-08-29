<div class="container-fluid">
    <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 animated fadeIn p-2">
            <a href="/customers">
                <div class="card card-plain h-100 bg-gradient-primary-light">
                    <div class="p-3">
                        <div class="row">
                            <div class="col-9 col-lg-8 col-md-8 col-sm-9">
                                <div>
                                    <h3 id="total-customer" class="mb-0 text-capitalize text-white font-weight-bold">00</h3>
                                    <p class="mb-0 text-lg text-white">Customer</p>
                                </div>
                            </div>
                            <div class="col-3 col-lg-4 col-md-4 col-sm-3 text-end">
                                <div class="icon icon-shape bg-gradient-light-2 shadow float-end border-radius-md">
                                    <img class="w-100" src="{{ asset('icons/customer.ico') }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 animated fadeIn p-2">
            <a href="/categories">
                <div class="card card-plain h-100 bg-gradient-primary-light">
                    <div class="p-3">
                        <div class="row">
                            <div class="col-9 col-lg-8 col-md-8 col-sm-9">
                                <div>
                                    <h3 id="total-category" class="mb-0 text-capitalize text-white font-weight-bold">00</h3>
                                    <p class="mb-0 text-lg text-white">Category</p>
                                </div>
                            </div>
                            <div class="col-3 col-lg-4 col-md-4 col-sm-3 text-end">
                                <div class="icon icon-shape bg-gradient-light-2 shadow float-end border-radius-md">
                                    <img class="w-100" src="{{ asset('icons/category.ico') }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 animated fadeIn p-2">
            <a href="/products">
                <div class="card card-plain h-100 bg-gradient-primary-light">
                    <div class="p-3">
                        <div class="row">
                            <div class="col-9 col-lg-8 col-md-8 col-sm-9">
                                <div>
                                    <h3 id="total-product" class="mb-0 text-capitalize text-white font-weight-bold">00</h3>
                                    <p class="mb-0 text-lg text-white">Product</p>
                                </div>
                            </div>
                            <div class="col-3 col-lg-4 col-md-4 col-sm-3 text-end">
                                <div class="icon icon-shape bg-gradient-light-2 shadow float-end border-radius-md">
                                    <img class="w-100" src="{{ asset('icons/product.ico') }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 animated fadeIn p-2">
            <a href="/sales-report">
                <div class="card card-plain h-100 animated fadeIn bg-gradient-primary-light">
                    <div class="p-3">
                        <div class="row">
                            <div class="col-9 col-lg-8 col-md-8 col-sm-9">
                                <div>
                                    <h3 id="total-sale" class="mb-0 text-capitalize text-white font-weight-bold">00</h3>
                                    <p class="mb-0 text-lg text-white">Items Sold</p>
                                </div>
                            </div>
                            <div class="col-3 col-lg-4 col-md-4 col-sm-3 text-end">
                                <div class="icon icon-shape bg-gradient-light-2 shadow float-end border-radius-md">
                                    <img class="w-100" src="{{ asset('icons/sales.png') }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>


<script>
    const getStatistics = async () => {
        showLoader();
        try {
            const totalProduct = await axios.get('/total-product');
            const totalCategory = await axios.get('/total-category');
            const totalCustomer = await axios.get('/total-customer');
            const totalSale = await axios.get('/total-sale');
            hideLoader();

            DOM('total-customer', totalCustomer);
            DOM('total-product', totalProduct);
            DOM('total-category', totalCategory);
            DOM('total-sale', totalSale);

        } catch (error) {
            hideLoader();
            errorToast('Stastics loading failed')
        }

    }
    getStatistics();

    const DOM = (elementId, data) => {
        const element = document.getElementById(elementId);
      element.innerText = data['data']
    }
</script>
