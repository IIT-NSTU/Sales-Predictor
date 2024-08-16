<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Revenue Report</title>

    <style>
        .styled-table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            min-width: 400px;
            width: 100%;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        .styled-table thead tr {
            background-color: #009879;
            color: #ffffff;
            text-align: left;
        }

        .styled-table th,
        .styled-table td {
            padding: 12px 15px;
        }

        .styled-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }

        .nright {
            text-align: right;
        }

        th, td {
            padding: 10px
        }
    </style>
</head>

<body>

    <H1>Revenue Report</H1>
    <table>
        <tr>
            <td>From</td>
            <td>:</td>
            <td> {{ $fromDate }} </td>
        </tr>
        <tr>
            <td>To</td>
            <td>:</td>
            <td> {{ $toDate }} </td>
        </tr>
        <tr>
            <td>Generated at</td>
            <td>:</td>
            <td> {{ date('Y-m-d h:i:s A') }} </td>
        </tr>
    </table>
    <table class="styled-table">
        <thead>
            <tr>
                <th colspan="2">Income</th>
                <th colspan="2">Cost</th>
                <th>Revenue</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Sales</td>
                <td class="nright">{{ $total_sale }}</td>
                <td>Purchase</td>
                <td class="nright">{{ $total_purchase }}</td>
                <td class="nright" rowspan="4"><b>{{ $total_sale + $total_sale_due 
                    - $total_purchase - $total_purchase_due - $total_expense }}</b></td>
            </tr>
            <tr style="background-color: #ffffff">
                <td>Sales Due</td>
                <td class="nright">{{ $total_sale_due }}</td>
                <td>Purchase Due</td>
                <td class="nright">{{ $total_purchase_due }}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>Expense</td>
                <td class="nright">{{ $total_expense }}</td>       
            </tr>
            <tr  style="background-color: #ffffff">
                <td>Total</td>
                <td class="nright">{{ $total_sale + $total_sale_due }}</td>
                <td>Total</td>
                <td class="nright">{{ $total_purchase + $total_purchase_due + $total_expense }}</td>        
            </tr>
        </tbody>
    </table>

    <H3>Sale Details</H3>
    <table class="styled-table">
        <thead>
            <tr>
                <th>Invoice ID</th>
                <th>Date</th>
                <th>Customer</th>
                <th>Phone</th>
                <th>Paid</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sale_list as $invoice)
                <tr>
                    <td>{{ $invoice['id'] }}</td>
                    <td>{{ $invoice['date'] }}</td>
                    <td>{{ $invoice['customer']['name'] }}</td>
                    <td>{{ $invoice['customer']['mobile'] }}</td>
                    <td class="nright">{{ $invoice['paid'] }}</td>
                </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td class="nright">Total</td>
                <td class="nright"><b>{{ $total_sale }}</b></td>
            </tr>
        </tbody>
    </table>

    <H3>Purchase Details</H3>
    <table class="styled-table">
        <thead>
            <tr>
                <th>Invoice ID</th>
                <th>Date</th>
                <th>Customer</th>
                <th>Phone</th>
                <th>Paid</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($purchase_list as $invoice)
                <tr>
                    <td>{{ $invoice['id'] }}</td>
                    <td>{{ $invoice['date'] }}</td>
                    <td>{{ $invoice['customer']['name'] }}</td>
                    <td>{{ $invoice['customer']['mobile'] }}</td>
                    <td class="nright">{{ $invoice['paid'] }}</td>
                </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td class="nright">Total</td>
                <td class="nright"><b>{{ $total_purchase }}</b></td>
            </tr>
        </tbody>
    </table>

    <H3>Sale Due Collected</H3>
    <table class="styled-table">
        <thead>
            <tr>
                <th>Invoice ID</th>
                <th>Date</th>
                <th>Customer</th>
                <th>Phone</th>
                <th>Paid</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sale_due_list as $due)
                <tr>
                    <td>{{ $due['invoice']['id'] }}</td>
                    <td>{{ $due['date'] }}</td>
                    <td>{{ $due['customer']['name'] }}</td>
                    <td>{{ $due['customer']['mobile'] }}</td>
                    <td class="nright">{{ $due['amount'] }}</td>
                </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td class="nright">Total</td>
                <td class="nright"><b>{{ $total_sale_due }}</b></td>
            </tr>
        </tbody>
    </table>

    <H3>Purchase Due Paid</H3>
    <table class="styled-table">
        <thead>
            <tr>
                <th>Invoice ID</th>
                <th>Date</th>
                <th>Customer</th>
                <th>Phone</th>
                <th>Paid</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($purchase_due_list as $due)
                <tr>
                    <td>{{ $due['invoice']['id'] }}</td>
                    <td>{{ $due['date'] }}</td>
                    <td>{{ $due['customer']['name'] }}</td>
                    <td>{{ $due['customer']['mobile'] }}</td>
                    <td class="nright">{{ $due['amount'] }}</td>
                </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td class="nright">Total</td>
                <td class="nright"><b>{{ $total_purchase_due }}</b></td>
            </tr>
        </tbody>
    </table>

    <H3>Expense Details</H3>
    <table class="styled-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Reason</th>
                <th>Comment</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($expense_list as $expense)
                <tr>
                    <td>{{ $expense['date'] }}</td>
                    <td>{{ $expense['category']['name'] }}</td>
                    <td>{{ $expense['comment'] }}</td>
                    <td class="nright">{{ $expense['amount'] }}</td>
                </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td class="nright">Total</td>
                <td class="nright"><b>{{ $total_expense }}</b></td>
            </tr>
        </tbody>
    </table>
</body>

</html>
