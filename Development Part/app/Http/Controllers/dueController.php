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
                       ->where('user_id', '=', $userId)
                       ->where('remaining_due', '>', '0')
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
            $invoice = Invoice::where('id', '=', $invoice_id)->first();

            if ($invoice->count() === 1) {
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
            }
            throw new Exception("not found", 404);

        } catch (Exception $e) {
            return response()->json([
                "status" => "failed",
                "message" => "due updating failed"
            ], 400);
        }
    }
}
