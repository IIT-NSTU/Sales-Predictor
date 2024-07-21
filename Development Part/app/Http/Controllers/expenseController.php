<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;

class expenseController extends Controller
{
    function expensesPage()
    {
        return view('pages.dashboard.expense-page');
    }

    function expenseList(Request $request)
    {
        $userId = $request->header('userId');
        return Expense::with('category')->where('user_id', '=', $userId)->get();
    }

    function createExpense(Request $request)
    {
        try {
            $userId = $request->header('userId');
            $comment = $request->input('comment');
            if (!$comment) {
                $comment = "";
            }
            
            Expense::create([
                "user_id" => $userId,
                "amount" => $request->input('amount'),
                "comment" => $comment,
                "category_id" => $request->input('category_id')
            ]);
            return response()->json([
                "status" => "success",
                "message" => "Expense amount added successfully"
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                "status" => "failed",
                "message" => "something went wrong"
            ], 400);
        }
    }

    function updateExpense(Request $request)
    {
        $userId = $request->header('userId');
        $expenseId = $request->input('id');
        $comment = $request->input('comment');
        if (!$comment) {
            $comment = "";
        }

        try {
            $expense = Expense::where('id', '=', $expenseId)
                ->where('user_id', '=', $userId);

            if ($expense->count() === 1) {
                $expense->update([
                    "amount" => $request->input('amount'),
                    "comment" => $comment,
                    "category_id" => $request->input('category_id')
                ]);

                return response()->json([
                    "status" => "success",
                    "message" => "Expense updated successfully"
                ], 200);
            }
            throw new Exception("not found", 404);

        } catch (Exception $e) {
            return response()->json([
                "status" => "failed",
                "message" => "Expense updating failed"
            ], 400);
        }

    }

    function deleteExpense(Request $request)
    {
        $userId = $request->header('userId');
        $expenseId = $request->input('id');

        try {
            $expense = Expense::where('id', '=', $expenseId)
                ->where('user_id', '=', $userId);

            if ($expense->count() === 1) {
                $expense->delete();

                return response()->json([
                    "status" => "success",
                    "message" => "Expense deleted successfully"
                ], 200);
            }
            throw new Exception("not found", 404);

        } catch (Exception $e) {
            return response()->json([
                "status" => "failed",
                "message" => "Expense deleting failed"
            ], 400);
        }
    }

    function expenseById(Request $request)
    {
        $expenseId = $request->id;
        $userId = $request->header('userId');

        return Expense::where('user_id', '=', $userId)->where('id', '=', $expenseId)->first();
    }
}
