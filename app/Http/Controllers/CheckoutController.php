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
    /**
     * Muestra la página de checkout con los elementos del carrito.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function showCheckout()
    {
        $cartItems = Session::get('cartItems', []);
        return view('checkout', compact('cartItems'));
    }


    /**
     * Finaliza la compra y guarda la factura y las líneas de pedido en la base de datos.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function finalizarCompra()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('warning', 'Debe iniciar sesión para finalizar la compra.');
        }
    
        if (session()->has('compra_finalizada')) {
            return redirect()->route('pedido-realizado')->with('warning', 'La compra ya ha sido finalizada.');
        }
    
        $cartItems = session()->get('cartItems', []);
    
        if (empty($cartItems)) {
            return redirect()->back()->with('error', 'El carrito está vacío.');
        }
    
        $userId = Auth::id();
    
        $maxInvoiceNumber = Invoice::where('user_id', $userId)->max('num_invoice');
    
        $nextInvoiceNumber = $maxInvoiceNumber ? $maxInvoiceNumber + 1 : 1;
    
        $invoice = new Invoice();
        $invoice->num_invoice = $nextInvoiceNumber; 
        $invoice->date = now(); 
        $invoice->total = Cart::getTotal(); 
        $invoice->user_id = $userId; 
        $invoice->save();
    
        foreach ($cartItems as $item) {
            $line = new Line();
            $line->invoice_id = $invoice->id; 
            $line->product_id = $item['id']; 
            $line->amount = $item['quantity']; 
            $line->save();
    
            
            $product = Product::findOrFail($item['id']);
            $product->stock -= $item['quantity'];
            $product->save();
        }
    
        
        Cart::clear();
    
       
        session()->forget('cartItems');
    
        // Marcar la compra como finalizada
        /* session()->put('compra_finalizada', true); */
    
        // Redirige al usuario a la vista de pedido realizado después de finalizar la compra
        return redirect()->route('pedido-realizado')->with('success', '¡Pedido realizado con éxito!');
    }
    
}

    
  
