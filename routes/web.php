<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

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

Route::get('/', function () {
    return view('welcome');
});


// ============================================================ LAYOUT
Route::get('/layout', function () 
{
    return view('layout.layout');
});
Route::get('/adminlayoutlist', function () 
{
    return view('layout.adminlayoutlist');
});

// ============================================================ ADMIN
Route::get('/login-admin', [AdminController::class, 'login_admin']);
Route::post('/login-admin', [AdminController::class, 'login_admin_cek']);
Route::get('/logout-admin', [AdminController::class, 'logout_admin']);

Route::middleware(AdminMiddleware::class)->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'home']);
    Route::get('/admin/add-user', [AdminController::class, 'add_user']);
    Route::resource('/admin/add-user', UserController::class)->except(['index']);
});   