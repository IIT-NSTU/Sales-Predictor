<div class="container ms-0 mt-5">
    <!-- Add 'flex-row' class to display cards horizontally -->
    <div class="row justify-content-start flex-row">
        <div class="col-lg-6">
            <div class="card bg-white">
                <div class="card-body">
                    <h4 class="mb-3 text-primary-2">Prediction</h4>
                    <button onclick="getPredictionList(0)" class="btn bg-gradient-primary me-3">Today</button>
                    <button onclick="getPredictionList(7)" class="btn bg-gradient-primary me-3">7 days</button>
                    <button onclick="getPredictionList(30)" class="btn bg-gradient-primary">30 days</button>

                    <div class="mt-3" id="prediction_data"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card bg-white">
                <div class="card-body">
                    <h4 class="mb-3 text-primary-2">Top Selling Products</h4>
                    <ul id="productList" class="list-group" style="color:black">
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const getPredictionList = async (days) => {
        try {
            let currentDate = new Date().toJSON().slice(0, 10);
            prediction_data = document.getElementById('prediction_data');
            html = `<h6>Date : ` + currentDate + `</h6>`;
            html += `<table class="table" style="color:black">`;
            html += `<tr><th>Model</td><td>Quantity</th></tr>`;
            const res = await axios.get('/prediction-list/' + days);
            total = 0;
            res.data.forEach(function(item, index) {
                html+= `<tr><td>` + item.product.name + `</td><td>` + item.unit + `</td></tr>`;
                total += item.unit;
            })
            html+= `<tr><td><b>Total</b></td><td><b>` + total + `</b></td></tr>`;
            html += `</table>`;

            prediction_data.innerHTML = html;
        } catch (error) {
            errorToast('Something went wrong');
        }
    }
    getPredictionList(0);

    const getTopProductList = async () => {
        try {
            productList = document.getElementById('productList');
            const res = await axios.get('/top-product-list');
            res.data.forEach(function(item, index) {
                productList.innerHTML += 
                `<li class="list-group-item d-flex justify-content-between align-items-center">
                        ` + item.product.name + `
                    <span class="badge bg-gradient-primary-light">` + item.total_quantity + ` Purchases</span>
                </li>`;
            })
    
        } catch (error) {
            errorToast('Something went wrong');
        }

    }
    getTopProductList();
    
</script>    