<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Expense;
use App\Models\Due;

;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class reportController extends Controller
{
    function reportPage()
    {
        return view('pages.dashboard.sale-report');
    }

    function salesReport(Request $request)
    {
        $userId = $request->header('userId');
        $type = $request->type;

        $fromDate = $request->from;
        $toDate = $request->to;

        $invoice_sale = Invoice::where('user_id', $userId)
                          ->whereRaw("STR_TO_DATE(invoices.date, '%Y-%c-%e %r') BETWEEN STR_TO_DATE(?, '%Y-%c-%e %r') AND STR_TO_DATE(?, '%Y-%c-%e %r')", [$fromDate, $toDate])
                          ->where('type', 's');

        $invoice_purchase = Invoice::where('user_id', $userId)
                          ->whereRaw("STR_TO_DATE(invoices.date, '%Y-%c-%e %r') BETWEEN STR_TO_DATE(?, '%Y-%c-%e %r') AND STR_TO_DATE(?, '%Y-%c-%e %r')", [$fromDate, $toDate])
                          ->where('type', 'p');                          

        $expense = Expense::where('user_id', $userId)
                          ->whereRaw("STR_TO_DATE(expenses.date, '%Y-%c-%e %r') BETWEEN STR_TO_DATE(?, '%Y-%c-%e %r') AND STR_TO_DATE(?, '%Y-%c-%e %r')", [$fromDate, $toDate]);

        $sale_due = Due::where('user_id', $userId)
                       ->whereRaw("STR_TO_DATE(dues.date, '%Y-%c-%e %r') BETWEEN STR_TO_DATE(?, '%Y-%c-%e %r') AND STR_TO_DATE(?, '%Y-%c-%e %r')", [$fromDate, $toDate])                      
                       ->whereHas('invoice', function ($query) {
                            $query->where('type', 's');
                        });
   
        $purchase_due = Due::where('user_id', $userId)
                           ->whereRaw("STR_TO_DATE(dues.date, '%Y-%c-%e %r') BETWEEN STR_TO_DATE(?, '%Y-%c-%e %r') AND STR_TO_DATE(?, '%Y-%c-%e %r')", [$fromDate, $toDate])                    
                           ->whereHas('invoice', function ($query) {
                                $query->where('type', 'p');
                            });  
        
        $total_expense = $expense->sum('amount');
        $total_sale = $invoice_sale->sum('paid');
        $total_purchase = $invoice_purchase->sum('paid');
        $total_sale_due = $sale_due->sum('amount');
        $total_purchase_due = $purchase_due->sum('amount');

        $sale_list = $invoice_sale->with('customer')->get();
        $purchase_list = $invoice_purchase->with('customer')->get();
        $expense_list = $expense->with('category')->get();
        $sale_due_list = $sale_due->with('invoice')->with('customer')->get();      
        $purchase_due_list = $purchase_due->with('invoice')->with('customer')->get();      

        $data = [
            "fromDate" => $fromDate,
            "toDate" => $toDate,
            "total_expense" =>$total_expense,
            "total_sale" => $total_sale,
            "total_purchase" => $total_purchase,
            "total_sale_due" => $total_sale_due,
            "total_purchase_due" => $total_purchase_due,
            "sale_list" => $sale_list,
            "purchase_list" => $purchase_list,
            "expense_list" => $expense_list,
            "sale_due_list" => $sale_due_list,
            "purchase_due_list" => $purchase_due_list
        ];

        if ($type == 1) {
            $pdf = Pdf::loadView('pages.report.report', $data);
            return $pdf->download('report.pdf');
        } else {
            $pdf = Pdf::loadView('pages.report.revenue-report', $data);
            return $pdf->download('revenue-report.pdf');
        }
        
    }
}