<?php


use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


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
    /* acceder a los  productossolo si estas autenticado */
   /*  Route::get('/products', [ProductController::class, 'productList'])->name('products');  */
   Route::get('products', [ProductController::class, 'productList'])->name('products.list');
});

require __DIR__.'/auth.php';


Route::get('cart', [CartController::class, 'cartList'])->name('cart.list');
Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store');
Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('remove', [CartController::class, 'removeCart'])->name('cart.remove');
Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');


Route::get('/checkout', [CheckoutController::class, 'showCheckout'])->name('checkout');

Route::post('/finalizar-compra', [CheckoutController::class, 'finalizarCompra'])->name('finalizar-compra');

Route::view('/pedido-realizado', 'pedido-realizado')->name('pedido-realizado');


Route::get('/facturas', [InvoiceController::class, 'mostrarFacturas'])->name('facturas');
Route::get('/facturas/{factura_id}', [InvoiceController::class, 'detallesFactura'])->name('facturas_detalles');





/* Route::get('/pedidos', [UserController::class, 'showPedidos'])->name('pedidos'); */





