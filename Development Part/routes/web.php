<?php

use App\Http\Controllers\categoryController;
use App\Http\Controllers\customerController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\invoiceController;
use App\Http\Controllers\dueController;
use App\Http\Controllers\expenseController;
use App\Http\Controllers\productController;
use App\Http\Controllers\reportController;
use App\Http\Controllers\chartController;
use App\Http\Controllers\userController;
use App\Http\Controllers\PythonScriptController;
use App\Http\Middleware\tokenVerficationMiddleware;
use Illuminate\Support\Facades\Route;


// ------------- PAGE ROUTES ----------//
Route::controller(userController::class)->group(function () {
    Route::get('/login', 'loginPage');
    Route::get('/register', 'registerPage');
    Route::get('/send-code', 'sendOtpPage');
    Route::get('/verify-code', 'verifyOtpPage');
    Route::get('/verify-reg-code', 'verifyRegOtpPage');
    Route::get('/reset-password', 'resetPasswordPage')->middleware(tokenVerficationMiddleware::class);
});

//--- After Authentication
// Dashboard
Route::controller(dashboardController::class)->group(function () {
    Route::get('/', 'dashboardPage')->middleware(tokenVerficationMiddleware::class);
    Route::get('/user-profile', 'userProfilePage')->middleware(tokenVerficationMiddleware::class);
});
// Category
Route::controller(categoryController::class)->group(function () {
    Route::get('/categories', 'categoriesPage')->middleware(tokenVerficationMiddleware::class);
});

// Expense
Route::controller(expenseController::class)->group(function () {
    Route::get('/expenses', 'expensesPage')->middleware(tokenVerficationMiddleware::class);
});

// Product 
Route::controller(productController::class)->group(function () {
    Route::get('/products', 'productsPage')->middleware(tokenVerficationMiddleware::class);
});


// Customer
Route::controller(customerController::class)->group(function () {
    Route::get('/contacts', 'customersPage')->middleware(tokenVerficationMiddleware::class);
});

// Invoice
Route::controller(invoiceController::class)->group(function () {
    Route::get('/create-invoice', 'invoicePage')->middleware(tokenVerficationMiddleware::class);
    Route::get('/invoiceList', 'invoiceListPage')->middleware(tokenVerficationMiddleware::class);
});

// Due
Route::controller(dueController::class)->group(function () {
    Route::get('/dues', 'duesPage')->middleware(tokenVerficationMiddleware::class);
});

// Chart
Route::controller(chartController::class)->group(function () {
    Route::get('/charts', 'chartPage')->middleware(tokenVerficationMiddleware::class);
});

// Report
Route::controller(reportController::class)->group(function () {
    Route::get('/sales-report', 'reportPage')->middleware(tokenVerficationMiddleware::class);
});


//------------- API ROUTES ------------//

// Dashboard
Route::controller(dashboardController::class)->group(function () {
    Route::get('/total-customer', 'totalCustomer')->middleware(tokenVerficationMiddleware::class);
    Route::get('/total-product', 'totalProduct')->middleware(tokenVerficationMiddleware::class);
    Route::get('/total-category', 'totalCategory')->middleware(tokenVerficationMiddleware::class);
    Route::get('/total-sale', 'totalSale')->middleware(tokenVerficationMiddleware::class);
    Route::get('/prediction-list/{day}', 'predictionList')->middleware(tokenVerficationMiddleware::class);
    Route::get('/top-product-list', 'topProductList')->middleware(tokenVerficationMiddleware::class);
});

// Python Script
Route::controller(pythonScriptController::class)->group(function () {
    Route::get('/run-script', 'runScript')->middleware(tokenVerficationMiddleware::class);
});

// User
Route::controller(userController::class)->group(function () {
    Route::post('/user-register', 'userRegistration');
    Route::post('/user-login', 'userLogin');
    Route::post('/send-otp', 'sendOTPCode');
    Route::post('/verify-otp', 'verifyOTPCode');
    Route::get('/user-logout', 'userLogOut');

    // Verify Token
    Route::post('/reset-password', 'resetPassword')->middleware(tokenVerficationMiddleware::class);
    Route::get('/user-profile-details', 'userProfile')->middleware(tokenVerficationMiddleware::class);
    Route::post('/user-update', 'userUpdate')->middleware(tokenVerficationMiddleware::class);
    Route::post('/logo-update', 'userLogoUpdate')->middleware(tokenVerficationMiddleware::class);
    Route::post('/logo-delete', 'userLogoDelete')->middleware(tokenVerficationMiddleware::class);
    Route::post('/update-password', 'updatePassword')->middleware(tokenVerficationMiddleware::class);
});

// Category
Route::controller(categoryController::class)->group(function () {
    Route::post('/create-category', 'createCategory')->middleware(tokenVerficationMiddleware::class);
    Route::post('/update-category', 'updateCategory')->middleware(tokenVerficationMiddleware::class);
    Route::post('/delete-category', 'deleteCategory')->middleware(tokenVerficationMiddleware::class);
    Route::get('/category-list', 'categoryList')->middleware(tokenVerficationMiddleware::class);
    Route::get('/categorybytype/{type}', 'categoryByType')->middleware(tokenVerficationMiddleware::class);
});

// Expense
Route::controller(expenseController::class)->group(function () {
    Route::post('/create-expense', 'createExpense')->middleware(tokenVerficationMiddleware::class);
    Route::post('/update-expense', 'updateExpense')->middleware(tokenVerficationMiddleware::class);
    Route::post('/delete-expense', 'deleteExpense')->middleware(tokenVerficationMiddleware::class);
    Route::get('/expense-list', 'expenseList')->middleware(tokenVerficationMiddleware::class);
    Route::get('/expenses/{id}', 'expenseById')->middleware(tokenVerficationMiddleware::class);
});

// Customer
Route::controller(customerController::class)->group(function () {
    Route::post('/create-customer', 'createCustomer')->middleware(tokenVerficationMiddleware::class);
    Route::post('/update-customer', 'updateCustomer')->middleware(tokenVerficationMiddleware::class);
    Route::post('/delete-customer', 'deleteCustomer')->middleware(tokenVerficationMiddleware::class);
    Route::get('/customer-list', 'customerList')->middleware(tokenVerficationMiddleware::class);
    Route::get('/customers/{id}', 'customerById')->middleware(tokenVerficationMiddleware::class);
    Route::get('/customersbytype/{type}', 'customerByType')->middleware(tokenVerficationMiddleware::class);
});

// Product
Route::controller(productController::class)->group(function () {
    Route::post('/create-product', 'createProduct')->middleware(tokenVerficationMiddleware::class);
    Route::post('/update-product', 'updateProduct')->middleware(tokenVerficationMiddleware::class);
    Route::post('/delete-product', 'deleteProduct')->middleware(tokenVerficationMiddleware::class);
    Route::get('/product-list', 'productList')->middleware(tokenVerficationMiddleware::class);
    Route::get('/product-list-sale', 'productListSale')->middleware(tokenVerficationMiddleware::class);
    Route::get('/products/{id}', 'productById')->middleware(tokenVerficationMiddleware::class);
    Route::get('/productbycategory/{id}', 'productByCategory')->middleware(tokenVerficationMiddleware::class);
});

// Invoice
Route::controller(invoiceController::class)->group(function () {
    Route::post('/create-invoice', 'createInvoice')->middleware(tokenVerficationMiddleware::class);
    Route::get('/invoice-list', 'invoiceList')->middleware(tokenVerficationMiddleware::class);
    Route::post('/invoice-details', 'invoiceDetails')->middleware(tokenVerficationMiddleware::class);
    Route::post('/due-invoice-details', 'dueInvoiceDetails')->middleware(tokenVerficationMiddleware::class);
    Route::post('/delete-invoice', 'deleteInvoice')->middleware(tokenVerficationMiddleware::class);
});

// Due
Route::controller(dueController::class)->group(function () {
    Route::get('/due-list', 'dueList')->middleware(tokenVerficationMiddleware::class);
    Route::post('/update-due', 'updateDue')->middleware(tokenVerficationMiddleware::class);
});

// Report
Route::controller(reportController::class)->group(function () {
    Route::get('/sales-report/{from}/{to}/{type}', 'salesReport')->middleware(tokenVerficationMiddleware::class);
});

// Due
Route::controller(chartController::class)->group(function () {
    Route::post('/generate-chart', 'generateChart')->middleware(tokenVerficationMiddleware::class);
});