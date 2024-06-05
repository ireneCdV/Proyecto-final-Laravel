<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\CrudProduct;
use App\Http\Requests\CrudProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Storage;

class CrudProductsController extends Controller
{
    /**
     * Muestra una lista de los recursos.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        
        $products = Product::query();
        
        
        if ($request->has('orderBy')) {
            $orderBy = $request->input('orderBy');
            if ($orderBy === 'stock_desc') {
                $products->orderByDesc('stock');
            } elseif ($orderBy === 'stock_asc') {
                $products->orderBy('stock');
            } else {
                $products->orderBy('price', $orderBy);
            }
        }
        
        
        $crudproducts = $products->get();

        return view('crudproducts.index', compact('crudproducts'));
    }

    /**
     * Muestra el formulario para crear un nuevo recurso.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $categories = Category::all();
        return view('crudproducts.create', compact('categories'));
    }

    /**
     * Almacena un nuevo recurso en el almacenamiento.
     *
     * @param  \App\Http\Requests\CrudProductRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CrudProductRequest $request)
    {
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('images', $imageName, 'public');
        } else {
            $imagePath = 'default-image.jpg'; 
        }
    
        $crudproduct = new Product;
        $crudproduct->image = $imagePath;
        $crudproduct->name = $request->input('name');
        $crudproduct->description = $request->input('description');
        $crudproduct->price = $request->input('price');
        $crudproduct->stock = 0; 
        $crudproduct->brand = $request->input('brand');
        $crudproduct->category_id = $request->input('category_id');
        $crudproduct->save();
    
        $units = $request->input('units') ?? 0; 
        $crudproduct->users()->attach(auth()->user()->id, [
            'date' => now(),
            'units' => $units,
            'old_stock' => 0 
        ]);
    
        $crudproduct->stock += $units;
        $crudproduct->save();
    
        return redirect()->route('crudproducts.index')->with('success', 'Producto creado correctamente.');
    }

    /**
     * Muestra el recurso especificado.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $crudproduct = Product::findOrFail($id);
        return view('crudproducts.show',['crudproduct'=>$crudproduct]);
    }

    /**
     * Muestra el formulario para editar el recurso especificado.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $crudproduct = Product::findOrFail($id);
        $categories = Category::all();
        return view('crudproducts.edit', ['crudproduct' => $crudproduct, 'categories' => $categories]);
    }

    /**
     * Actualiza el recurso especificado en el almacenamiento.
     *
     * @param  \App\Http\Requests\CrudProductRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CrudProductRequest $request, $id)
    {
        $crudproduct = Product::findOrFail($id);
        
        if ($request->hasFile('new_image')) {
            $image = $request->file('new_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('images', $imageName, 'public');
    
            if ($crudproduct->image !== 'default-image.jpg' && Storage::disk('public')->exists($crudproduct->image)) {
                Storage::disk('public')->delete($crudproduct->image);
            }
    
            $crudproduct->image = $imagePath;
        }
    
        $crudproduct->name = $request->input('name');
        $crudproduct->description = $request->input('description');
        $crudproduct->price = $request->input('price');
        $crudproduct->brand = $request->input('brand');
        $crudproduct->category_id = $request->input('category_id');
    
        $oldStock = $crudproduct->stock;
    
        $unitsToAdd = $request->input('units') ?? 0;
        $crudproduct->stock += $unitsToAdd;
    
        $crudproduct->save();
    
        $crudproduct->users()->attach(auth()->user()->id, [
            'date' => now(),
            'units' => $unitsToAdd,
            'old_stock' => $oldStock
        ]);
    
        return redirect()->route('crudproducts.index')->with('success', 'Producto actualizado correctamente.');
    }

    /**
     * Elimina el recurso especificado del almacenamiento.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $crudproduct = Product::findOrFail($id);
        $crudproduct->delete();

        return to_route('crudproducts.index')->with('success', 'Producto eliminado correctamente.');
    }
}
