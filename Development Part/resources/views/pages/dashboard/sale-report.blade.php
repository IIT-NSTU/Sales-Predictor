@extends('layout.app')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h4>Sales Report</h4>
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
                        <label class="form-label mt-2">Select option</label>
                        <select type="text" class="form-control form-select" id="reportType">
                            <option value="1">Product Record</option>
                            <option value="2">Revenue</option>
                        </select>
                    </div>
                </div>
                <button onclick="SalesReport()" class="btn mt-3 bg-gradient-primary">Generate Report</button>
            </div>
        </div>
    </div>
@endsection


<script>
    function SalesReport() {
        const FromDate = document.getElementById('FormDate').value;
        const ToDate = document.getElementById('ToDate').value;
        const Type = document.getElementById('reportType').value;

        if (FormDate.length === 0 || ToDate.length === 0) {
            errorToast("Date range required ")
        } else {
            window.open('/sales-report/'+FromDate+'/'+ToDate+'/'+Type);
        }
    }
</script>
