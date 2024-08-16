<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Report</title>

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

    <H1>Product Report</H1>
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
   
    
    <H3>Sale By Category</H3>
    <table class="styled-table" style="text-align: center;">
        <thead>
            <tr>
                <th>Category Name</th>
                <th>Product Quantity</th>
            </tr>
        </thead>
        {{ $category_name = $category_sales[0]['category_name']; }}
        @php 
            $total = 0; 
            $grandTotal = 0; 
        @endphp
        <tbody>
            @foreach ($category_sales as $product)
                @if ($product['category_name'] != $category_name)
                <tr>
                    <td>{{ $category_name }}</td>
                    <td>{{ $total }}</td>
                    @php 
                        $grandTotal += $total; 
                        $total = 0;
                        $category_name = $product['category_name'];
                    @endphp
                </tr>
                @endif
                    
                {{ $total += $product['total_quantity_sold']; }}

            @endforeach
                <tr>
                    <td>{{ $category_name }}</td>
                    <td>{{ $total }}</td>
                </tr>
                <tr>
                    <td><b>Total</b></td>
                    <td><b>{{ $grandTotal + $total }}</b></td>
                </tr>
        </tbody>
    </table>

    <H3>Individual Product Sale</H3>
    <table class="styled-table" style="text-align: center;">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Product Quantity</th>
            </tr>
        </thead>
        {{ $category_name = $category_sales[0]['category_name']; }}
        @php 
            $total = 0; 
            $grandTotal = 0; 
        @endphp
        <tbody>
            @foreach ($category_sales as $product)
                @if ($product['category_name'] != $category_name)
                <tr>
                    <td><b>Total {{ $category_name }}</b></td>
                    <td><b>{{ $total }}</b></td>
                    @php 
                        $grandTotal += $total; 
                        $total = 0;
                        $category_name = $product['category_name'];
                    @endphp
                </tr>
                @endif
                <tr>
                    <td>{{ $product['product_name'] }}</td>
                    <td>{{ $product['total_quantity_sold'] }}</td>
                    {{ $total += $product['total_quantity_sold']; }}
                </tr>
            @endforeach
                <tr>
                    <td><b>Total {{ $category_name }}</b></td>
                    <td><b>{{ $total }}</b></td>
                </tr>
                <tr>
                    <td><b>Grand Total</b></td>
                    <td><b>{{ $grandTotal + $total }}</b></td>
                </tr>
        </tbody>
    </table>

    <H3>Sale Details</H3>
    <table class="styled-table" style="text-align: center;">
        <thead>
            <tr>
                <th>Date</th>
                <th>Product Name</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($product_sale as $product)
                <tr>
                    <td>{{ $product['invoice']['date'] }}</td>
                    <td>{{ $product['product']['name'] }}</td>
                    <td>{{ $product['quantity'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <hr>

    <H3>Purchage By Category</H3>
    <table class="styled-table" style="text-align: center;">
        <thead>
            <tr>
                <th>Category Name</th>
                <th>Product Quantity</th>
            </tr>
        </thead>
        {{ $category_name = $category_purchase[0]['category_name']; }}
        @php 
            $total = 0; 
            $grandTotal = 0; 
        @endphp
        <tbody>
            @foreach ($category_purchase as $product)
                @if ($product['category_name'] != $category_name)
                <tr>
                    <td>{{ $category_name }}</td>
                    <td>{{ $total }}</td>
                    @php 
                        $grandTotal += $total; 
                        $total = 0;
                        $category_name = $product['category_name'];
                    @endphp
                </tr>
                @endif
                    
                {{ $total += $product['total_quantity_sold']; }}

            @endforeach
                <tr>
                    <td>{{ $category_name }}</td>
                    <td>{{ $total }}</td>
                </tr>
                <tr>
                    <td><b>Total</b></td>
                    <td><b>{{ $grandTotal + $total }}</b></td>
                </tr>
        </tbody>
    </table>

    <H3>Individual Product Purchase</H3>
    <table class="styled-table" style="text-align: center;">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Product Quantity</th>
            </tr>
        </thead>
        {{ $category_name = $category_purchase[0]['category_name']; }}
        @php 
            $total = 0; 
            $grandTotal = 0; 
        @endphp
        <tbody>
            @foreach ($category_purchase as $product)
                @if ($product['category_name'] != $category_name)
                <tr>
                    <td><b>Total {{ $category_name }}</b></td>
                    <td><b>{{ $total }}</b></td>
                    @php 
                        $grandTotal += $total; 
                        $total = 0;
                        $category_name = $product['category_name'];
                    @endphp
                </tr>
                @endif
                <tr>
                    <td>{{ $product['product_name'] }}</td>
                    <td>{{ $product['total_quantity_sold'] }}</td>
                    {{ $total += $product['total_quantity_sold']; }}
                </tr>
            @endforeach
                <tr>
                    <td><b>Total {{ $category_name }}</b></td>
                    <td><b>{{ $total }}</b></td>
                </tr>
                <tr>
                    <td><b>Grand Total</b></td>
                    <td><b>{{ $grandTotal + $total }}</b></td>
                </tr>
        </tbody>
    </table>

    <H3>Purchase Details</H3>
    <table class="styled-table" style="text-align: center;">
        <thead>
            <tr>
                <th>Date</th>
                <th>Product Name</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($product_purchase as $product)
                <tr>
                    <td>{{ $product['invoice']['date'] }}</td>
                    <td>{{ $product['product']['name'] }}</td>
                    <td>{{ $product['quantity'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
