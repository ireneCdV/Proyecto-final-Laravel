<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    /**
     * Muestra los detalles de un producto y los productos relacionados.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
    
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->limit(2) 
            ->get();

        return view('show', compact('product', 'relatedProducts'));
    }


    /**
     * Muestra una lista de productos con opciones de filtrado y ordenación.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\View
     */
    public function productList(Request $request)
    {
        $products = Product::query();
    
        $categories = Category::all();
    
        $brands = Product::distinct()->pluck('brand');
    
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $products->where('name', 'like', '%' . $searchTerm . '%');
        }
    
        if ($request->filled('category') && $request->input('category') != 'all') {
            $categoryID = $request->input('category');
            $products->where('category_id', $categoryID);
        }
    
        if ($request->filled('brand')) {
            $brand = $request->input('brand');
            $products->where('brand', $brand);
        }
    
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
    
        $products = $products->paginate(6)->appends($request->all());
    
        $productsCount = $products->total();
    
        $noResults = $products->isEmpty();
    
        return view('products', compact('products', 'categories', 'noResults', 'brands'));
    }
}
