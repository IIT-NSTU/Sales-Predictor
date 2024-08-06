@extends('layout.app')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h4>Charts</h4>
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <label class="form-label mt-2">Date From</label>
                        <input id="FormDate" type="date" class="form-control" />
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <label class="form-label mt-2">Date To</label>
                        <input id="ToDate" type="date" class="form-control" />
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <label class="form-label mt-2">Select Category</label>
                        <select onchange="fillChartProductDropDown()" type="text" class="form-control form-select" id="categoryList">
                            <option value="0">All</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <label class="form-label mt-2">Select Product</label>
                        <select type="text" class="form-control form-select" id="productList">
                        </select>
                    </div>
                </div>
                <button onclick="generateChart()" class="btn mt-3 bg-gradient-primary">Generate Chart</button>
            </div>
        </div>

        <div class="card mt-3 mb-3 d-none" id="chart_area">
            <div class="card-body">
                <div id="curve_chart"></div>
            </div>
        </div>
    </div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    const fillChartCategoryDropDown = async () => {
        const categoryDropdown = document.getElementById('categoryList');

        try {
            const res = await axios.get('/category-list');
            res.data.data.forEach(category => {
                if (category.products_count > 0) {
                    categoryDropdown.innerHTML += (
                        `<option value="${category.id}">
                            ${category.name}
                        </option>`
                    );
                }
            });
        } catch (error) {
            console.log(error);
        }
    }
    fillChartCategoryDropDown();

    const fillChartProductDropDown = async () => {
        const category = document.getElementById('categoryList').value;
        const productDropdown = document.getElementById('productList');
        productDropdown.innerHTML = '<option value="0">All</option>';
        try {
            const res = await axios.get('/productbycategory/' + category);
            res.data.map(product => {
                productDropdown.innerHTML += (
                    `<option value="${product['id']}">
                        ${product['name']}
                    </option>`);
            })
        } catch (error) {
            console.log(error);
        }
    }
    fillChartProductDropDown();

    function generateChart() {
        const FromDate = document.getElementById('FormDate').value;
        const ToDate = document.getElementById('ToDate').value;

        if (FormDate.length === 0 || ToDate.length === 0) {
            errorToast("Date range required ")
        } else {
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);
        }
    }
    
    const drawChart = async () =>  {
        document.getElementById('chart_area').classList.remove('d-none');

        var data = new google.visualization.DataTable();
        data.addColumn('date', 'Date');

        const productList = document.getElementById('productList');
        const productID = productList.value;
        const FromDate = document.getElementById('FormDate').value;
        const ToDate = document.getElementById('ToDate').value;
        
        showLoader();
        try {
            if (productID == 0) {
                const responses = [];
                for (const option of productList.options) {
                    if (option.value != 0) {
                        data.addColumn('number', option.text);
                        const res = await axios.post('/generate-chart', {
                            product_id: option.value,
                            from_date: FromDate,
                            to_date: ToDate
                        });
                        responses.push(res.data);
                    }
                }
                const dates = [];
                const dateObjects = [];
                const products = [];
                products.push(dateObjects);

                responses.forEach(item => {
                    item.forEach(innerItem => {
                        let date = innerItem.date.split(" ")[0];
                        if (!dates.includes(date)) {
                            dates.push(date);
                            let s = date.split("-");
                            dateObjects.push(new Date(s[0], s[1] - 1, s[2]));
                        }
                    })
                    const product = [];
                    products.push(product);
                });

                let index = 1;
                responses.forEach(item => {
                    dates.forEach(date => {
                        let count = 0;
                        item.forEach(innerItem => {
                            if (innerItem.date.split(" ")[0] === date) {
                                count += parseInt(innerItem.quantity);
                            }
                        })
                        products[index].push(count);
                    })
                    index++;
                });

                const chart = [];
                for (let i = 0; i < dates.length; i++) {
                    const chartData = [];
                    for (let j = 0; j < products.length; j++) {
                        chartData.push(products[j][i]);
                    }
                    chart.push(chartData);
                }

                console.log(dates);
                console.log(products);
                console.log(chart);
                data.addRows(chart);
                data.sort([{ column: 0 }]);
            } else {
                data.addColumn('number', productList.options[productList.selectedIndex].text);
                const res = await axios.post('/generate-chart', {
                    product_id: productID,
                    from_date: FromDate,
                    to_date: ToDate
                });
                let rows = [];
                res.data.forEach(item => {
                    let date = item.date.split(" ")[0];
                    let s = date.split("-");
                    let row = [new Date(s[0], s[1] - 1, s[2]), parseInt(item.quantity)];
                    rows.push(row);
                });
                data.addRows(rows);
            }
            hideLoader(); 
        } catch (error) {
            errorToast('Chart generation failed ');
            console.log(error);
        }

        var options = {
          title: 'Sales Data',
          curveType: 'function',
          legend: { position: 'bottom' },
          width: 1200,
          height: 600,
          hAxis: {
            title: 'Date',
            format: 'MMM dd, yyyy'
          },
          vAxis: {
            title: 'Quantity'
          },
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
        chart.draw(data, options);
    }
</script>

@endsection
