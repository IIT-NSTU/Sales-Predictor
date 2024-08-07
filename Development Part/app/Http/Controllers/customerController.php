<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;

class customerController extends Controller
{
    function customersPage()
    {
        return view('pages.dashboard.customer-page');
    }

    function customerList(Request $request)
    {
        $userId = $request->header('userId');
        return Customer::where('user_id', '=', $userId)->get();
    }

    function createCustomer(Request $request)
    {
        try {
            $userId = $request->header('userId');
            Customer::create([
                "user_id" => $userId,
                "name" => $request->input('name'),
                "email" => $request->input('email'),
                "mobile" => $request->input('mobile'),
                "address" => $request->input('address'),
                "type" => $request->input('type'),
            ]);
            return response()->json([
                "status" => "success",
                "message" => "Customer created successfully"
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                "status" => "failed",
                "message" => "something went wrong"
            ], 400);
        }
    }

    function updateCustomer(Request $request)
    {
        $userId = $request->header('userId');
        $customerId = $request->input('id');

        try {
            $customer = Customer::where('id', '=', $customerId)
                ->where('user_id', '=', $userId);

            if ($customer->count() === 1) {
                $customer->update([
                    "name" => $request->input('name'),
                    "email" => $request->input('email'),
                    "mobile" => $request->input('mobile'),
                    "address" => $request->input('address'),
                    "type" => $request->input('type'),
                ]);

                return response()->json([
                    "status" => "success",
                    "message" => "customer updated successfully"
                ], 200);
            }
            throw new Exception("not found", 404);

        } catch (Exception $e) {
            return response()->json([
                "status" => "failed",
                "message" => "customer updating failed"
            ], 400);
        }

    }

    function deleteCustomer(Request $request)
    {
        $userId = $request->header('userId');
        $customerId = $request->input('id');

        try {
            $customer = Customer::where('id', '=', $customerId)
                ->where('user_id', '=', $userId);

            if ($customer->count() === 1) {
                $customer->delete();

                return response()->json([
                    "status" => "success",
                    "message" => "customer deleted successfully"
                ], 200);
            }
            throw new Exception("not found", 404);

        } catch (Exception $e) {
            return response()->json([
                "status" => "failed",
                "message" => "customer deleting failed"
            ], 400);
        }
    }


    function customerById(Request $request)
    {
        $customerId = $request->id;
        $userId = $request->header('userId');

        return Customer::where('user_id', '=', $userId)->where('id', '=', $customerId)->first();
    }

    function customerByType(Request $request)
    {
        $customerType = $request->type;
        $userId = $request->header('userId');

        return Customer::where('user_id', '=', $userId)->where('type', '=', $customerType)->get();
    }
}