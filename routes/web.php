<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DetailProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/shop-grid/{id}', [ProductController::class, 'index'])->name('shop-grid');
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/{id}', [PageController::class, 'index'])->name('index');
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/shop-details/{id}', [DetailProductController::class, 'index'])->name('shop-details');
Route::get('/login', [UserController::class, 'showLogin'])->name('showLogin');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/register', [UserController::class, 'showRegister'])->name('showRegister');
Route::post('/register', [UserController::class, 'register'])->name('register');
Route::get('/dangXuat/{id}', [UserController::class, 'dangXuat'])->name('logout');


Route::post('/addCart/{id}', [CartController::class, 'addCartPost'])->name('addCartPost');
Route::get('/addCart/{id}', [CartController::class, 'addCartGet'])->name('addCartGet');
Route::get('/deleteCart/{rowId}', [CartController::class, 'deleteItem'])->name('deleteCart');
Route::get('/shoping-cart/{id}', [CartController::class, 'showCart'])->name('showCart');


Route::get('addOrder/{productId}/{}',[CartController::class, 'inQuality'])->name('inQuality');


// Route::get('/', function(){
//     return view('admin.layout.layout.index');
// });


// Route::get('/login', function(){
//     return view('login');
// })->name('showLogin');





// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

// require __DIR__.'/auth.php';
