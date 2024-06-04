<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    /**
     * Muestra los elementos del carrito.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function showCart()
    {
        $cartItems = \Cart::getContent();
    
        $total = \Cart::getTotal();
    
        return view('cart', ['cartItems' => $cartItems, 'total' => $total]);
    }


    /**
     * Muestra la lista de elementos del carrito.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function cartList()
    {
        $cartItems = \Cart::getContent();

        if ($cartItems->isEmpty()) {
            session()->flash('warning', 'El carrito está vacío.');
        }

        return view('cart', compact('cartItems'));
    }
    

    /**
     * Agrega un producto al carrito.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addToCart(Request $request)
    {
        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $request->image,
            )
        ]);
    
        session()->put('cartItems', \Cart::getContent());
    
        session()->flash('success', '¡El producto se agregó al carrito exitosamente!');
        return redirect()->route('cart.list');
    }


    /**
     * Actualiza la cantidad de un producto en el carrito.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateCart(Request $request)
    {
        $product = Product::findOrFail($request->id);
        
        if ($request->quantity <= 0) {
            \Cart::remove($request->id);
            session()->flash('success', 'El producto se eliminó del carrito');
            return redirect()->route('cart.list');
        }
    
        if ($request->quantity > $product->stock) {
            if ($product->stock == 0) {
                return redirect()->back()->with('error', '¡Lo sentimos, este producto está agotado!');
            }
            return redirect()->back()->with('Opss!', '¡Lo sentimos, no tenemos suficientes productos en stock!');
        }
    
        \Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity
                ],
            ]
        );
        session()->flash('success', 'El carrito se actualizó correctamente');
        return redirect()->route('cart.list');
    }

    /**
     * Elimina un producto del carrito.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeCart(Request $request)
    {
        \Cart::remove($request->id);
        session()->flash('success', 'Articulo eliminado');
        return redirect()->route('cart.list');
    }

    /**
     * Vacía el carrito entero.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clearAllCart()
    {
        \Cart::clear();
        session()->flash('success', 'Carrito Vacio');
        return redirect()->route('cart.list');
    }
}
