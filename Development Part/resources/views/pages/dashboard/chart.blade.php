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
        const categoryList = document.getElementById('categoryList');
        const productID = productList.value;
        const FromDate = document.getElementById('FormDate').value;
        const ToDate = document.getElementById('ToDate').value;

        let dateArray = [];
        let currentDate = new Date(FromDate);

        while (currentDate <= new Date(ToDate)) {
            let formattedDate = currentDate.toISOString().split('T')[0];
            dateArray.push(formattedDate);
            currentDate.setDate(currentDate.getDate() + 1);
        }
        
        showLoader();
        try {
            if (productID == 0) {
                data.addColumn('number', categoryList.options[categoryList.selectedIndex].text);
                let responseMap = new Map();
                let rows = [];
                for (const option of productList.options) {
                    if (option.value != 0) {
                        const res = await axios.post('/generate-chart', {
                            product_id: option.value,
                            from_date: FromDate,
                            to_date: ToDate
                        });
                        res.data.forEach(response => {
                            let date = new Date(response.date.split(" ")[0]);
                            date.setDate(date.getDate() + 1); // Adjust date if necessary
                            targetDate = date.toISOString().split('T')[0];
                            let quantity = parseInt(response.quantity);
                            if (responseMap.has(targetDate)) {
                                quantity += responseMap.get(targetDate)
                            }
                            responseMap.set(targetDate, quantity);
                        });
                    }
                }
                // Process rows using the map for O(1) lookups
                dateArray.forEach(item => {
                    let quantity = responseMap.get(item) || 0; // Get quantity from map, default to 0 if not found
                    let [year, month, day] = item.split("-").map(Number);
                    rows.push([new Date(year, month - 1, day), quantity]); // Add row with date and quantity
                });
                data.addRows(rows);
                data.sort([{ column: 0 }]);
            } else {
                data.addColumn('number', productList.options[productList.selectedIndex].text);
                const res = await axios.post('/generate-chart', {
                    product_id: productID,
                    from_date: FromDate,
                    to_date: ToDate
                });
                let rows = [];
                // Pre-process response data into a map for quick lookup
                let responseMap = new Map();
                res.data.forEach(response => {
                    let date = new Date(response.date.split(" ")[0]);
                    date.setDate(date.getDate() + 1); // Adjust date if necessary
                    responseMap.set(date.toISOString().split('T')[0], parseInt(response.quantity));
                });
                // Process rows using the map for O(1) lookups
                dateArray.forEach(item => {
                    let quantity = responseMap.get(item) || 0; // Get quantity from map, default to 0 if not found
                    let [year, month, day] = item.split("-").map(Number);
                    rows.push([new Date(year, month - 1, day), quantity]); // Add row with date and quantity
                });
                data.addRows(rows);
                data.sort([{ column: 0 }]);
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
          pointSize: 5
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
        chart.draw(data, options);
    }
</script>

@endsection
