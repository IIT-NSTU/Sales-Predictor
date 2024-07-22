<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Due;
use App\Models\Invoice;

class dueController extends Controller
{
    function duesPage()
    {
        return view('pages.dashboard.due-page');
    }

    
    function dueList(Request $request)
    {
        $userId = $request->header('userId');
        $dues = Invoice::with('customer')
                       ->withCount('dues')
                       ->where('user_id', '=', $userId)
                       ->get();

        return response()->json([
            "status" => "success",
            "message" => "",
            "data" => $dues
        ], 200);
    }

    function updateDue(Request $request)
    {
        $userId = $request->header('userId');
        $invoice_id = $request->input('id');

        try {
            $invoice = Invoice::where('id', '=', $invoice_id)
                              ->where('user_id', '=', $userId)
                              ->first();

                $invoice->update([
                    "remaining_due" => $invoice->remaining_due - $request->input('amount')
                ]);

                Due::create([
                    "date" => $request->input('date'),
                    "amount" => $request->input('amount'),
                    "invoice_id" => $invoice_id,
                    "user_id" => $userId,
                    "customer_id" => $request->input('cid'),
                ]);
    
                return response()->json([
                    "status" => "success",
                    "message" => "Due amount updated successfully"
                ], 200);

        } catch (Exception $e) {
            return response()->json([
                "status" => "failed",
                "message" => "due updating failed"
            ], 400);
        }
    }
}
