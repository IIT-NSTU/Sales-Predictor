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
        $dues = Due::where('user_id', '=', $userId)->with('invoice')->with('customer')->get();

        return response()->json([
            "status" => "success",
            "message" => "",
            "data" => $dues
        ], 200);
    }

    function updateDue(Request $request)
    {
        $userId = $request->header('userId');
        $dueId = $request->input('id');

        try {
            $due = Due::with('invoice')
                ->where('id', '=', $dueId)
                ->where('user_id', '=', $userId)
                ->first();

            if ($due->count() === 1) {
                $due->update([
                    "dates" => $due->dates . $request->input('date') . ',' ,
                    "amounts" => $due->amounts . $request->input('amount') . ','
                ]);

                $invoice = Invoice::where('id', '=', $due->invoice->id)->first();
                $invoice->update([
                    "due" => $invoice->due - $request->input('amount')
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
