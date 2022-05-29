<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DetailProductController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Bill_detailController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ReviewController;
use App\Models\Bill_detail;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Review;

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
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/shop-details/{id}', [DetailProductController::class, 'index'])->name('shop-details');
Route::get('/login', [UserController::class, 'showLogin'])->name('showLogin');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/register', [UserController::class, 'showRegister'])->name('showRegister');
Route::post('/register', [UserController::class, 'register'])->name('register');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/auth.profile', [UserController::class, 'showProfile'])->name('showProfile');
Route::get('/auth.edit-profile', [UserController::class, 'showEditProfile'])->name('showEditProfile');
Route::post('/updateProfile', [UserController::class, 'updateProfile'])->name('updateProfile');
Route::post('/changePassword', [UserController::class, 'changePassword'])->name('changePassword');

//cart
Route::post('/addCart/{id}', [CartController::class, 'addCartPost'])->name('addCartPost');
Route::get('/addCart/{id}', [CartController::class, 'addCartGet'])->name('addCartGet');
Route::get('/deleteCart/{rowId}', [CartController::class, 'deleteItem'])->name('deleteCart');
Route::get('/shoping-cart', [CartController::class, 'showCart'])->name('showCart');
Route::get('/deQty/{rowID}', [CartController::class, 'deQty'])->name('deQty');
Route::get('/inQty/{rowID}', [CartController::class, 'inQty'])->name('inQty');


Route::get('/checkout', [PageController::class, 'checkout'])->name('checkout')->middleware('auth')->middleware('checkCheckout');
Route::post('/addBill',[Bill_detailController::class, 'addBill'])->name('addBill');
Route::get('/bill-detail/{bill_id}', [Bill_detailController::class, 'showBillDetail'])->name('showBillDetail');
Route::get('/deleteBill/{bill_id}', [Bill_detailController::class, 'deleteBill'])->name('deleteBill');
Route::get('/showEditBill/{bill_id}', [Bill_detailController::class, 'showEditBill'])->name('showEditBill');
Route::post('/editBill/{bill_id}', [Bill_detailController::class, 'editBill'])->name('editBill');
Route::get('/successBill/{bill_id}', [Bill_detailController::class, 'successBill'])->name('successBill');

Route::get('/wishlist', [WishlistController::class, 'showWishlist'])->name('showWishlist')->middleware('auth');
// Route::get('/showWishlist', [WishlistController::class, 'showWishlist'])->name('showWishlist')->middleware('auth');
Route::get('/addWishlist/{id}', [WishlistController::class, 'addWishlist'])->name('addWishlist')->middleware('auth');

//admin
Route::get('/item/{id}', [AdminController::class, 'item'])->name('item');
Route::get('/showProduct', [AdminController::class, 'showProduct'])->name('showProduct');
Route::get('/showProtype', [AdminController::class, 'showProtype'])->name('showProtype');
Route::get('/showBill', [AdminController::class, 'showBill'])->name('showBill');
Route::get('/showOrder', [AdminController::class, 'showOrder'])->name('showOrder');
Route::get('/showUser', [AdminController::class, 'showUser'])->name('showUser');
Route::get('/showWishlistAdmin', [AdminController::class, 'showWishlistAdmin'])->name('showWishlistAdmin');
Route::get('/showSelling', [AdminController::class, 'showSelling'])->name('showSelling');
Route::get('/showReview', [AdminController::class, 'showReview'])->name('showReview');


//product
Route::get('/ShowAddProduct', [AdminController::class, 'ShowAddProduct'])->name('ShowAddProduct');
Route::get('/ShowEditProduct/{id}', [AdminController::class, 'ShowEditProduct'])->name('ShowEditProduct');
Route::post('/addProduct', [AdminController::class, 'addProduct'])->name('addProduct');
Route::post('/editProduct/{id}', [AdminController::class, 'editProduct'])->name('editProduct');
Route::get('/deleteProduct/{id}', [AdminController::class, 'deleteProduct'])->name('deleteProduct');


//protype
Route::post('/addProtype', [AdminController::class, 'addProtype'])->name('addProtype');
Route::post('/editProtype/{id}', [AdminController::class, 'editProtype'])->name('editProtype');
Route::get('/deleteProtype/{id}', [AdminController::class, 'deleteProtype'])->name('deleteProtype');


//bill
Route::get('/showEditBill_admin/{id}', [AdminController::class, 'showEditBill_admin'])->name('showEditBill_admin');
Route::post('/editBill_admin/{id}', [AdminController::class, 'editBill_admin'])->name('editBill_admin');
Route::get('/deleteBill_admin/{id}', [AdminController::class, 'deleteBill_admin'])->name('deleteBill_admin');


//user
Route::get('/deleteUser/{id}', [AdminController::class, 'deleteUser'])->name('deleteUser');
Route::post('/addUser', [AdminController::class, 'addUser'])->name('addUser');

//comment
Route::post('/addComment/{id}', [ReviewController::class, 'addComment'])->name('addComment');
Route::get('/deleteComment/{id}', [ReviewController::class, 'deleteComment'])->name('deleteComment');


Route::get('/{id}', [PageController::class, 'index'])->name('index');
Route::get('/admin/{id}', [AdminController::class, 'index'])->name('admin')->middleware('auth')->middleware('checkAdmin');
// Route::get('/admin/index', [AdminController::class, 'showAdminIndex'])->name('showAdminIndex')->middleware('auth')->middleware('checkAdmin');


