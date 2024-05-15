<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function productList(Request $request)
    {
        // Inicializar la consulta de productos
        $products = Product::query();
    
        // Obtener todas las categorías
        $categories = Category::all();
    
        // Obtener todas las marcas disponibles
        $brands = Product::distinct()->pluck('brand');
    
        // Filtrar por nombre si se proporciona un valor de búsqueda
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $products->where('name', 'like', '%' . $searchTerm . '%');
        }
    
        // Filtrar por categoría si se selecciona una
        if ($request->filled('category') && $request->input('category') != 'all') {
            $categoryID = $request->input('category');
            $products->where('category_id', $categoryID);
        }
    
        // Filtrar por marca si se selecciona una
        if ($request->filled('brand')) {
            $brand = $request->input('brand');
            $products->where('brand', $brand);
        }
    
        // Ordenar los productos
        if ($request->filled('orderBy')) {
            $orderBy = $request->input('orderBy');
            if ($orderBy === 'stock_desc') {
                $products->orderByDesc('stock');
            } elseif ($orderBy === 'stock_asc') {
                $products->orderBy('stock');
            } else {
                $products->orderBy('price', $orderBy);
            }
        }
    
        // Paginar los productos y mantener los filtros en la paginación
        $products = $products->paginate(6)->appends($request->all());
    
        // Contar el número de productos
        $productsCount = $products->total();
    
        // Verificar si no se encontraron resultados
        $noResults = $products->isEmpty();
    
        return view('products', compact('products', 'categories', 'noResults', 'brands'));
    }
    

  
}
