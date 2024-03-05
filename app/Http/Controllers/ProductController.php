<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productList(Request $request)
    {
        $products = Product::query();
    
        // Filtrar por nombre si se proporciona un valor de búsqueda
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $products->where('name', 'like', '%' . $searchTerm . '%');
        }

        // Filtrar productos con stock mayor que cero
        $products->where('stock', '>', 0);
    
        // Ordenar los productos
        if ($request->has('orderBy')) {
            $orderBy = $request->input('orderBy');
            $products->orderBy('price', $orderBy);
        }
    
        // Obtener los productos
        $products = $products->get();
    
        // Verificar si no se encontraron resultados
        $noResults = $products->isEmpty();
    
        return view('products', compact('products', 'noResults'));
    }
}
