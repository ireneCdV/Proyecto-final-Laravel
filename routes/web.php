<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CitasController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CrudAdminsController;
use App\Http\Controllers\CrudCategoriesController;
use App\Http\Controllers\CrudProductsController;
use App\Http\Controllers\CrudServicesController;
use App\Http\Controllers\CrudCitasController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Mail;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Rutas protegidas que requieren autenticación
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rutas de perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas de productos y carrito
    Route::get('products', [ProductController::class, 'productList'])->name('products.list');
    Route::get('/productos/{id}', [ProductController::class, 'show'])->name('productos.show');
    Route::get('cart', [CartController::class, 'cartList'])->name('cart.list');
    Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store');
    Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update');
    Route::post('remove', [CartController::class, 'removeCart'])->name('cart.remove');
    Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');

    // Rutas de checkout y facturación
    Route::get('/checkout', [CheckoutController::class, 'showCheckout'])->name('checkout');
    Route::post('/finalizar-compra', [CheckoutController::class, 'finalizarCompra'])->name('finalizar-compra');
    Route::view('/pedido-realizado', 'pedido-realizado')->name('pedido-realizado');
    Route::get('/facturas', [InvoiceController::class, 'mostrarFacturas'])->name('facturas');
    Route::get('/facturas/{factura_id}', [InvoiceController::class, 'detallesFactura'])->name('facturas_detalles');
    Route::get('/facturas/{invoice_id}/pdf', [InvoiceController::class, 'descargarPDF'])->name('descargar_pdf');

});


//Citas
Route::middleware('auth')->group(function(){
    Route::resource('citas', CitasController::class);
});

Route::get('/available-hours', [CitasController::class, 'getAvailableHours'])->name('available-hours');


//CRUD  ADMINS
Route::middleware('auth')->group(function(){
    Route::resource('crudadmins', CrudAdminsController::class);
});

//CRUD  Categorias
Route::middleware('auth')->group(function(){
    Route::resource('crudcategories', CrudCategoriesController::class);
});

//CRUD  Servicios 
Route::middleware('auth')->group(function(){
    Route::resource('crudservices', CrudServicesController::class);
});

//CRUD  productos 
Route::middleware('auth')->group(function(){
    Route::resource('crudproducts', CrudProductsController::class);
});

//CRUD  Categorias
Route::middleware('auth')->group(function(){
    Route::resource('crudcitas', CrudCitasController::class);
});


// Rutas de inicio de sesión para usuarios y trabajadores
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');


/* Actualizar estado de la cita */
Route::post('/citas/update-status', [CitasController::class, 'updateStatus'])->name('citas.update-status');


/* Contacto */
Route::get('/contacto', [ContactController::class, 'show'])->name('contacto');
Route::post('/contacto/submit', [ContactController::class, 'submit'])->name('contact.submit');

    
/* Enviar email al pedir la cita */
Route::get('/send-test-email', function () {
    $user = \App\Models\User::find(1); // Reemplaza con un usuario válido

    Mail::raw('This is a test email.', function ($message) use ($user) {
        $message->to($user->email)
                ->subject('Test Email');
    });

    return 'Email sent!';
});






require __DIR__ . '/auth.php';

