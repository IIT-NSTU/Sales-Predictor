<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Expense;
use App\Models\Due;
use App\Models\InvoiceProduct;

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

        if ($type == 1) {
            $category_sales = InvoiceProduct::whereHas('invoice', function ($query) use ($fromDate, $toDate, $userId) {
                $query->where('type', 's')
                      ->where('user_id', $userId)
                      ->whereRaw("STR_TO_DATE(invoices.date, '%Y-%c-%e %r') BETWEEN STR_TO_DATE(?, '%Y-%c-%e %r') AND STR_TO_DATE(?, '%Y-%c-%e %r')", [$fromDate, $toDate]);
            })
            ->join('products', 'invoice_products.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('categories.name as category_name', 'products.name as product_name', 'products.category_id')
            ->selectRaw('SUM(invoice_products.quantity) as total_quantity_sold')
            ->groupBy('products.category_id', 'products.name', 'categories.name')
            ->orderBy('categories.id')
            ->get();                             

            $product_sale = InvoiceProduct::where('user_id', $userId)
                            ->whereHas('invoice', function ($query) use ($fromDate, $toDate, $userId) {
                                $query->where('type', 's');
                                $query->where('user_id', $userId);
                                $query->whereRaw("STR_TO_DATE(invoices.date, '%Y-%c-%e %r') BETWEEN STR_TO_DATE(?, '%Y-%c-%e %r') AND STR_TO_DATE(?, '%Y-%c-%e %r')", [$fromDate, $toDate]);
                            })
                            ->with('invoice')
                            ->with('product')
                            ->get(); 


            $category_purchase = InvoiceProduct::whereHas('invoice', function ($query) use ($fromDate, $toDate, $userId) {
                $query->where('type', 'p')
                      ->where('user_id', $userId)
                      ->whereRaw("STR_TO_DATE(invoices.date, '%Y-%c-%e %r') BETWEEN STR_TO_DATE(?, '%Y-%c-%e %r') AND STR_TO_DATE(?, '%Y-%c-%e %r')", [$fromDate, $toDate]);
            })
            ->join('products', 'invoice_products.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('categories.name as category_name', 'products.name as product_name', 'products.category_id')
            ->selectRaw('SUM(invoice_products.quantity) as total_quantity_sold')
            ->groupBy('products.category_id', 'products.name', 'categories.name')
            ->orderBy('categories.id')
            ->get();  

            $product_purchase = InvoiceProduct::whereHas('invoice', function ($query) use ($fromDate, $toDate, $userId) {
                            $query->where('type', 'p');
                            $query->where('user_id', $userId);
                            $query->whereRaw("STR_TO_DATE(invoices.date, '%Y-%c-%e %r') BETWEEN STR_TO_DATE(?, '%Y-%c-%e %r') AND STR_TO_DATE(?, '%Y-%c-%e %r')", [$fromDate, $toDate]);
                        })
                        ->with('invoice')
                        ->with('product')
                        ->get();                 
                            
            $data = [
                "fromDate" => $fromDate,
                "toDate" => $toDate,
                "product_sale" => $product_sale,
                "category_sales" => $category_sales,
                "product_purchase" => $product_purchase,
                "category_purchase" => $category_purchase
            ];                

            $pdf = Pdf::loadView('pages.report.product-report', $data);
            return $pdf->stream('product-report.pdf');
        } else {
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

            $pdf = Pdf::loadView('pages.report.revenue-report', $data);
            return $pdf->stream('revenue-report.pdf');
        }
        
    }
}