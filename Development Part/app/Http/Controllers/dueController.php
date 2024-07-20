<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Due;

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
}
