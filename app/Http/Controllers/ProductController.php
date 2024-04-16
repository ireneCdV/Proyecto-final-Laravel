<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productList(Request $request)
    {
        // Obtener todos los productos
        $products = Product::query();
    
        // Filtrar por nombre si se proporciona un valor de búsqueda
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $products->where('name', 'like', '%' . $searchTerm . '%');
        }

        // Filtrar por categoría si se selecciona una
        if ($request->has('category') && $request->input('category') != 'all') {
            $categoryID = $request->input('category');
            $products->where('category_id', $categoryID);
        }

        // Filtrar productos con stock mayor que cero
        $products->where('stock', '>', 0);
    
        // Ordenar los productos
        if ($request->has('orderBy')) {
            $orderBy = $request->input('orderBy');
            $products->orderBy('price', $orderBy);
        }
    
        // Obtener todas las categorías
        $categories = Category::all();
    
        // Contar el número de productos
        $productsCount = $products->count();
    
        // Verificar si no se encontraron resultados
        $noResults = $productsCount === 0;
    
        // Obtener los productos
        $products = $products->get();
    
        return view('products', compact('products', 'categories', 'noResults'));
    }
}
