<?php

use App\Http\Livewire\Admin\AdminAddProductComponent;
use App\Http\Livewire\Admin\AdminEditCategoryComponent;
use App\Http\Livewire\Admin\AdminProductComponent;
use App\Http\Livewire\Admin\AdminSaleComponent;
use App\Http\Livewire\AdminAddHomesliderComponent;
use App\Http\Livewire\AdminEditHomesliderComponent;
use App\Http\Livewire\AdminEditProductComponent;
use App\Http\Livewire\AdminHomeCategoryComponent;
use App\Http\Livewire\AdminHomesliderComponent;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\ShopComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\User\UserDashboardComponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\SearchComponent;
use App\Http\Livewire\Admin\AdminCategoryComponent;
use App\Http\Livewire\Admin\AdminAddCategoryComponent;

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


Route::get('/', HomeComponent::class);
Route::get('/shop', ShopComponent::class)
    ->name('shop');
Route::get('/product/{slug}', DetailsComponent::class)
    ->name('product.details');
Route::get('/product-category/{category_slug}', CategoryComponent::class)
    ->name('product.category');
Route::get('/search', SearchComponent::class)
    ->name('product.search');
Route::middleware('auth')->group(function () {
    Route::get('/cart', CartComponent::class)
        ->name('cart');
    Route::get('checkout', CheckoutComponent::class)
        ->name('checkout');
});

/*Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');*/

//For User or Customer
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/user/dashboard', UserDashboardComponent::class)
        ->name('user.dashboard');
});

//For Admin
Route::middleware(['auth:sanctum', 'verified', 'auth.admin'])->group(function () {
    Route::get('/admin/dashboard', AdminDashboardComponent::class)
        ->name('admin.dashboard');
    Route::get('/admin/categories', AdminCategoryComponent::class)
        ->name('admin.categories');
    Route::get('/admin/category/add', AdminAddCategoryComponent::class)
        ->name('admin.category.add');
    Route::get('/admin/category/{slug}/edit', AdminEditCategoryComponent::class)
        ->name('admin.category.edit');
    Route::get('/admin/products', AdminProductComponent::class)
        ->name('admin.products');
    Route::get('/admin/product/add', AdminAddProductComponent::class)
        ->name('admin.product.add');
    Route::get('/admin/product/{slug}/edit', AdminEditProductComponent::class)
        ->name('admin.product.edit');
    Route::get('/admin/homeslider', AdminHomesliderComponent::class)
        ->name('admin.homeslider');
    Route::get('/admin/homeslider/add', AdminAddHomesliderComponent::class)
        ->name('admin.homeslider.add');
    Route::get('/admin/homeslider/{id}/edit', AdminEditHomesliderComponent::class)
        ->name('admin.homeslider.edit');
    Route::get('/admin/home-categories', AdminHomeCategoryComponent::class)
        ->name('admin.home.category');
    Route::get('/admin/sale', AdminSaleComponent::class)
        ->name('admin.sale');
});
