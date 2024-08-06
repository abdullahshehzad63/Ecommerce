<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\AttributeValue;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\front\MainController;
use App\Http\Controllers\ProductAttribute;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Group;

use App\Http\Controllers\HomeController;


// use App\Http\Controllers\ProductController;
// use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('admin/dashboard',[HomeController::class,'index'])->name('admin.index')->middleware(['auth','admin']);
Route::get('admin/category',[CategoryController::class,'index'])->name('category.index')->middleware(['auth','admin']);
Route::post('admin/categoryStore',[CategoryController::class,'store'])->name('category.store')->middleware(['auth','admin']);
Route::get('admin/categoryEdit/{edit}',[CategoryController::class,'edit'])->name('category.edit')->middleware(['auth','admin']);
Route::put('admin/categoryUpdate/{id}',[CategoryController::class,'update'])->name('category.update')->middleware(['auth','admin']);
Route::delete("admin/categoryDelete/{id}",[CategoryController::class,'delete'])->name("category.delete")->middleware(['auth','admin']);

// Routes for products are listed here
Route::get('admin/product',[ProductController::class,'index'])->name('product.index')->middleware(['auth','admin']);
Route::get('admin/createProduct',[ProductController::class,'create'])->name('product.create')->middleware(['auth','admin']);
Route::post('admin/productStore',[ProductController::class,'store'])->name('product.store')->middleware(['auth','admin']);
Route::get('admin/productEdit/{id}',[ProductController::class,'edit'])->name('product.edit')->middleware(['auth','admin']);
Route::get('admin/productImageDelete/{id}',[ProductController::class,'deleteImages'])->name('productImage.delete');
Route::put('admin/productUpdate/{id}',[ProductController::class,'update'])->name("product.update")->middleware(['auth','admin']);
Route::get('admin/productDelete/{id}',[ProductController::class,'delete'])->name('product.delete')->middleware(['auth','admin']);

// Routes for Product Attributes are listed here

Route::get('admin/productAttribute',[ProductAttribute::class,'index'])->name('productAttribute.index')->middleware(['auth','admin']);
Route::get('admin/productAttribute/create',[ProductAttribute::class,'create'])->name('productAttribute.create')->middleware(['auth','admin']);
Route::post('admin/productAttrbute/store',[ProductAttribute::class,'store'])->name('productAttribute.store')->middleware(['auth','admin']);
Route::get('admin/productAttributeEdit/{id}',[ProductAttribute::class,'edit'])->name('productAttribute.edit')->middleware(['auth','admin']);
Route::put('admin/productAttributeUpdate/{id}',[ProductAttribute::class,'update'])->name('productAttribute.update')->middleware(['auth','admin']);
Route::delete('admin/productAttributeDelete/{id}',[ProductAttribute::class,'delete'])->name('productAttribute.delete')->middleware(['auth','admin']);
// This is the route for user side price and color fetching on the basis of size;
Route::get('product-attributes/details', [ProductAttribute::class, 'getAttributeDetails'])->name('product.attributes.details');
// Routes for Product Attributes are listed here

Route::get('admin/attributeValue',[AttributeValue::class,'index'])->name('attributeValues.index')->middleware(['auth','admin']);
Route::get('admin/attributeValue/create',[AttributeValue::class,'create'])->name('attributeValues.create')->middleware(['auth','admin']);
Route::post('admin/attributeValue/store',[AttributeValue::class,'store'])->name('attributeValues.store')->middleware(['auth','admin']);
Route::delete('admin/attributeValuesDelete/{id}',[AttributeValue::class,'delete'])->name('attributeValues.delete')->middleware(['auth','admin']);
Route::get('admin/attributeValueEdit/{id}',[AttributeValue::class,'edit'])->name('attributeValues.edit')->middleware(['auth','admin']);
Route::put('admin/attributeValueUpdate/{id}',[AttributeValue::class,'update'])->name('attributeValues.update')->middleware(['auth','admin']);


// Routes for product Purchases are displayed here

Route::get("/admin/productPurchases",[PurchaseController::class,'index'])->name('productPurchases.index')->middleware(['auth','admin']);
Route::get('/admin/productPurchases/create',[PurchaseController::class,'create'])->name('productPurchases.create')->middleware(['auth','admin']);
Route::post('/admin/productPurchases/store',[PurchaseController::class,'store'])->name('productPurchases.store')->middleware(['admin','auth']);
Route::delete('/admin/productPurchasesDelete/{id}',[PurchaseController::class,'delete'])->name('productPurchases.delete')->middleware(['admin','auth']);
Route::get('/admin/purchaseProductEdit/{id}',[PurchaseController::class,'edit'])->name('productPurchases.edit')->middleware(['auth','admin']);
Route::put('/admin/purchaseProductUpdate/{id}',[PurchaseController::class,'update'])->name("productPurchases.update")->middleware(['auth','admin']);
// Routes for checking the trashed purchased items

Route::get('/admin/trashedProductPurchased',[PurchaseController::class,'trashedPurchasedProducts'])->name('productPurchases.trahsed')->middleware(['auth','admin']);
Route::get('/admin/restoredProductPurchases/{id}',[PurchaseController::class,'restored'])->name('productPurchases.restored')->middleware(['auth','admin']);
 

Route::get("/home",[MainController::class,'index'])->name('front.home');
Route::get('/shopDetails/{id}',[MainController::class,'shopDetails'])->name('shopDetails.home');


Route::get('product-attributes/{product_id}', [ProductAttribute::class, 'getProduct']);

Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add')->middleware('auth');

Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');
Route::get('/shoppingCart',[CartController::class,'shopping'])->name('front.shoppingcart');
Route::delete('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
Route::get('/checkout',[CheckoutController::class,'index'])->name('front.checkout');
Route::post('/checkout/checkoutStore',[CheckoutController::class,'store'])->name('checkout.store');

Route::get('product-specifications/{id}', [ProductAttribute::class, 'productGetAttributeDetails']);
// Route::resource('productPurchases',  PurchaseController::class);

Route::get('/product/attributes/{id}', [ProductController::class, 'getProductAttributes'])->name('product.attributes');
