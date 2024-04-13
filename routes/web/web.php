<?php

use App\Http\Middleware\EnsureCustomerCredentialsAreVerified;
use App\Http\Controllers\HomeController;

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
// Route::middleware([Authenticate::class, EnsureIsCustomer::class, EnsureCustomerCredentialsAreVerified::class])
//      ->group(function ()
// {
//     // ...
// });

// Admins only routes
// Route::middleware([Authenticate::class, EnsureIsAdmin::class])
//      ->group(function ()
// {
// });

require __DIR__.'/auth/auth.php';
require __DIR__.'/customer-profile.php';
require __DIR__.'/admin/additional-services.php';
require __DIR__.'/admin/printing-technologies.php';
require __DIR__.'/admin/filament-types.php';
require __DIR__.'/admin/baseModels.php';
require __DIR__.'/catalog/catalog-items.php';
require __DIR__.'/catalog/catalog-item.php';
