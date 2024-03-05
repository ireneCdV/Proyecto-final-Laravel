<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function showCart()
    {
        // Obtener todos los elementos del carrito
        $cartItems = \Cart::getContent();
    
        // Calcular el total del carrito
        $total = \Cart::getTotal();
    
        // Puedes iterar sobre $cartItems para mostrar cada elemento en tu vista
        return view('cart', ['cartItems' => $cartItems, 'total' => $total]);
    }

    public function cartList()
    {
        $cartItems = \Cart::getContent();

        // Verificar si el carrito está vacío
        if ($cartItems->isEmpty()) {
            session()->flash('warning', 'El carrito está vacío.');
        }

        return view('cart', compact('cartItems'));
    }
    

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


    
    public function updateCart(Request $request)
    {
        $product = Product::findOrFail($request->id);
        
        // Verificar si la cantidad es menor o igual a cero
        if ($request->quantity <= 0) {
            \Cart::remove($request->id);
            session()->flash('success', 'El producto se eliminó del carrito');
            return redirect()->route('cart.list');
        }
    
        // Verificar si el producto está en stock
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

    public function removeCart(Request $request)
    {
        \Cart::remove($request->id);
        session()->flash('success', 'Articulo eliminado');
        return redirect()->route('cart.list');
    }

    public function clearAllCart()
    {
        \Cart::clear();
        session()->flash('success', 'Carrito Vacio');
        return redirect()->route('cart.list');
    }
}
