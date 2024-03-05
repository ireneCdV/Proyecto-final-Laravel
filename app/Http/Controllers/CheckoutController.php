<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Line;
use App\Models\Product;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class CheckoutController extends Controller
{
    public function showCheckout()
    {
        $cartItems = Session::get('cartItems', []);
        return view('checkout', compact('cartItems'));
    }



    public function finalizarCompra()
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('login')->with('warning', 'Debe iniciar sesión para finalizar la compra.');
        }
    
        // Verificar si la compra ya se finalizó
        if (session()->has('compra_finalizada')) {
            return redirect()->route('pedido-realizado')->with('warning', 'La compra ya ha sido finalizada.');
        }
    
        // Obtén los elementos del carrito de la sesión
        $cartItems = session()->get('cartItems', []);
    
        // Verificar si el carrito está vacío
        if (empty($cartItems)) {
            return redirect()->back()->with('error', 'El carrito está vacío.');
        }
    
        // Obtén el ID del usuario actual
        $userId = Auth::id();
    
        // Obtén el número de factura más alto para el usuario actual
        $maxInvoiceNumber = Invoice::where('user_id', $userId)->max('num_invoice');
    
        // Determina el número de factura para la nueva factura
        $nextInvoiceNumber = $maxInvoiceNumber ? $maxInvoiceNumber + 1 : 1;
    
        // Crea una nueva factura en la base de datos
        $invoice = new Invoice();
        $invoice->num_invoice = $nextInvoiceNumber; // Número de factura para el usuario actual
        $invoice->date = now(); // Fecha actual
        $invoice->total = Cart::getTotal(); // El total del pedido
        $invoice->user_id = $userId; // El ID del usuario que realizó el pedido
        $invoice->save();
    
        // Guarda cada elemento del carrito como una nueva línea en la tabla line
        foreach ($cartItems as $item) {
            $line = new Line();
            $line->invoice_id = $invoice->id; // ID de la factura creada
            $line->product_id = $item['id']; // ID del producto
            $line->amount = $item['quantity']; // Cantidad del producto, ajustada a 'amount'
            $line->save();
    
            // Reducir el stock del producto
            $product = Product::findOrFail($item['id']);
            $product->stock -= $item['quantity'];
            $product->save();
        }
    
        //Vaciar carrito después de finalizar la compra
        Cart::clear();
    
        // Limpiar los elementos del carrito de la sesión
        session()->forget('cartItems');
    
        // Marcar la compra como finalizada
        /* session()->put('compra_finalizada', true); */
    
        // Redirige al usuario a la vista de pedido realizado después de finalizar la compra
        return redirect()->route('pedido-realizado')->with('success', '¡Pedido realizado con éxito!');
    }
    
}

    
  
