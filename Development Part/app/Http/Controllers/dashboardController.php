<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceProduct;
use App\Models\Product;
use App\Models\Prediction;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class dashboardController extends Controller
{
    function dashboardPage()
    {
        return view('pages.dashboard.dashboard-page');
    }
    function userProfilePage()
    {
        return view('pages.dashboard.profile-page');
    }
    function totalCustomer(Request $request)
    {
        $userId = $request->header('userId');
        return Customer::where('user_id', $userId)->where('type', '=', '1')->count();
    }

    function totalProduct(Request $request)
    {
        $userId = $request->header('userId');
        return Product::where('user_id', $userId)->count();
    }

    
    function totalCategory(Request $request)
    {
        $userId = $request->header('userId');
        return Category::whereHas('products')
                        ->where('user_id', $userId)
                        ->where('active', '=', '1')
                        ->count();
    }

    function totalSale(Request $request)
    {
        $userId = $request->header('userId');
        return InvoiceProduct::where('user_id', $userId)->sum('quantity');
    }

    function predictionList(Request $request) {
        $userId = $request->header('userId');
        $day = $request->day;
        $fromDate = Carbon::today();
        $current = Carbon::now();
   
        $toDate = $current->addDays($day);
        
        return Prediction::with('product')
        ->selectRaw('product_id, SUM(unit) as unit')
        ->where('user_id', $userId)
        ->whereRaw("STR_TO_DATE(predictions.date, '%Y-%c-%e %r') BETWEEN STR_TO_DATE(?, '%Y-%c-%e %r') AND STR_TO_DATE(?, '%Y-%c-%e %r')", [$fromDate->toDateString(), $toDate->toDateString()])
        ->groupBy('product_id')
        ->get();
    }

    function topProductList(Request $request) {
        $userId = $request->header('userId');
        return InvoiceProduct::with('product')
            ->where('user_id', $userId)
            ->select('product_id', DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('product_id')
            ->orderByDesc('total_quantity')
            ->limit(10)
            ->get();
    }
}