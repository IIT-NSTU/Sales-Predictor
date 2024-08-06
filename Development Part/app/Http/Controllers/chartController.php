<?php

namespace App\Http\Controllers;

use App\Models\InvoiceProduct;
use Illuminate\Http\Request;

class chartController extends Controller
{
    function chartPage() {
        return view('pages.dashboard.chart');
    }

    function generateChart(Request $request) {
        $userId = $request->header('userId');
        $productId = $request->input('product_id');
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        return InvoiceProduct::join('invoices', 'invoice_products.invoice_id', '=', 'invoices.id')
                             ->where('invoice_products.product_id', $productId)
                             ->where('invoice_products.user_id', $userId)
                             ->whereRaw("STR_TO_DATE(invoices.date, '%Y-%c-%e %r') BETWEEN STR_TO_DATE(?, '%Y-%c-%e %r') AND STR_TO_DATE(?, '%Y-%c-%e %r')", [$fromDate, $toDate])
                             ->select('invoice_products.quantity', 'invoices.date')
                             ->get();
    }
}
