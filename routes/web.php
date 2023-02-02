<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\auth;
use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\admin\CountryController;
use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\Admin\HistoryController;
use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\frontend\RateController;
use App\Http\Controllers\frontend\UserController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\SearchController;


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

Route::get('/', function () {
  return view('index');
});
Auth::routes();
Route::group([
  'prefix' => 'admin',
  'middleware' => 'admin',
], function () {
  Route::get('/', function () {
    return view('adminFolder/dashboard');
  });
  Route::get('/profile', [ProfileController::class, 'index']);
  Route::post('/profile', [ProfileController::class, 'update']);

  Route::get('/country', [CountryController::class, 'index']);
  Route::get('/country/add', [CountryController::class, 'create']);
  Route::post('/country/add', [CountryController::class, 'store']);
  Route::get('/country/edit/{id}', [CountryController::class, 'edit']);
  Route::post('/country/edit/{id}', [CountryController::class, 'update']);
  Route::get('/country/delete/{id}', [CountryController::class, 'destroy']);

  Route::get('/blog', [BlogController::class, 'index']);
  Route::get('/blog/add', [BlogController::class, 'create']);
  Route::post('/blog/add', [BlogController::class, 'store']);
  Route::get('/blog/edit/{id}', [BlogController::class, 'edit']);
  Route::post('/blog/edit/{id}', [BlogController::class, 'update']);
  Route::get('/blog/delete/{id}', [BlogController::class, 'destroy']);

  Route::get('/category', [CategoryController::class, 'index']);
  Route::get('/category/add', [CategoryController::class, 'create']);
  Route::post('/category/add', [CategoryController::class, 'store']);
  Route::get('/category/edit/{id}', [CategoryController::class, 'edit']);
  Route::post('/category/edit/{id}', [CategoryController::class, 'update']);
  Route::get('/category/delete/{id}', [CategoryController::class, 'destroy']);
  // brand
  Route::get('/brand', [BrandController::class, 'index']);
  Route::get('/brand/add', [BrandController::class, 'create']);
  Route::post('/brand/add', [BrandController::class, 'store']);
  Route::get('/brand/edit/{id}', [BrandController::class, 'edit']);
  Route::post('/brand/edit/{id}', [BrandController::class, 'update']);
  Route::get('/brand/delete/{id}', [BrandController::class, 'destroy']);

  //history
  Route::get('/history', [HistoryController::class, 'index']);
});


// frontend
Route::group([
  'prefix' => 'fe'
], function () {
  Route::get('/', [HomeController::class, 'index'])->name('home');
  Route::get('/detail/{id}', [HomeController::class, 'show'])->name('product-detail');
  Route::post('/add-to-cart', [HomeController::class, 'addToCart'])->name('add-to-cart');
  Route::get('/cart', [CartController::class, 'index'])->name('cart');
  Route::post('/cart/quantity_up', [CartController::class, 'quantity_up'])->name('cart-quantity-up');
  Route::post('/cart/quantity_down', [CartController::class, 'quantity_down'])->name('cart-quantity-down');
  Route::post('/cart/delete_item', [CartController::class, 'delete_item'])->name('cart-delete-item');
  Route::post('/cart/checkout', [CheckoutController::class, 'store'])->name('cart-checkout');
  Route::post('/cart/logined/checkout', [CheckoutController::class, 'submitCart']);


  Route::get('/blogs', [App\Http\Controllers\Frontend\BlogController::class, 'index'])->name("blog-list");
  Route::get('/blogs/view/{id}', [App\Http\Controllers\Frontend\BlogController::class, 'show']);
  Route::post('/blogs/view/comment', [CommentController::class, 'store'])->name('blog-comment');
  Route::post('/blogs/view/reply', [CommentController::class, 'reply'])->name('blog-reply');
  Route::post('/blogs/rating', [RateController::class, 'store'])->name('blog-rate');

  Route::group([
    'prefix' => 'account',
    'middleware' => 'member'
  ], function () {
    Route::get('/profile', [UserController::class, 'edit'])->name('profile');
    Route::post('/profile', [UserController::class, 'update'])->name('profile-update');
    //products
    Route::get('/product', [ProductController::class, 'index'])->name('product-list');
    Route::get('/product/add', [ProductController::class, 'create'])->name('add-product');
    Route::post('/product/add', [ProductController::class, 'store']);
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('edit-product');
    Route::post('/product/edit/{id}', [ProductController::class, 'update']);
    Route::get('/product/delete/{id}', [ProductController::class, 'destroy'])->name('delete-product');
  });
  //search
  Route::get('/search', [SearchController::class, 'index'])->name('search');
  Route::post('/search', [SearchController::class, 'showListSearch'])->name('show-list-search');
  Route::get('/search_fill', [SearchController::class, 'index']);
  Route::post('/search_fill', [SearchController::class, 'showListFill'])->name('show-list-fill');

  Route::post('/search_fill_price', [SearchController::class, 'showListFillPrice'])->name('show-list-fill-price');
});

Route::group([
  'middleware' => 'checkUserIsLogined'
], function () {
  Route::get('/signin', [UserController::class, 'index'])->name('fe-login');
});
Route::post('/signin', [UserController::class, 'login']);
Route::get('/logout', [UserController::class, 'logout'])->name('fe-logout');
Route::get('/signup', function () {
  return view('frontend/auth/signUp');
});
Route::post('/signup', [UserController::class, 'store']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);