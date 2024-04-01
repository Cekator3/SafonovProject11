<?php

use App\Http\Middleware\EnsureCustomerCredentialsAreVerified;
use App\Http\Middleware\EnsureIsAdmin;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\EnsureIsCustomer;
use Illuminate\Auth\Middleware\Authenticate;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// General routes for customers and administrators
Route::middleware([EnsureCustomerCredentialsAreVerified::class])->group(function () 
{
    Route::get('/', HomeController::class)->name('home');
});


// Customers only routes
Route::middleware([Authenticate::class, EnsureIsCustomer::class, EnsureCustomerCredentialsAreVerified::class])
     ->group(function () 
{
    // ...
});

// Admins only routes
Route::middleware([Authenticate::class, EnsureIsAdmin::class])
     ->group(function ()
{
});

require __DIR__.'/auth/auth.php';
