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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        // Inicializar la consulta de productos
        $products = Product::query();
        
        // Ordenar los productos
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
        
        // Obtener todos los productos paginados
        $crudproducts = $products->get();

        return view('crudproducts.index', compact('crudproducts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
{
    $categories = Category::all();
    return view('crudproducts.create', compact('categories'));
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  CrudProductRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CrudProductRequest $request)
    {
        // Procesar la imagen
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('images', $imageName, 'public');
        } else {
            $imagePath = 'default-image.jpg'; // Asumiendo que tienes una imagen predeterminada
        }
    
        // Crear un nuevo producto con los datos del formulario y la ruta de la imagen
        $crudproduct = new Product;
        $crudproduct->image = $imagePath;
        $crudproduct->name = $request->input('name');
        $crudproduct->description = $request->input('description');
        $crudproduct->price = $request->input('price');
        $crudproduct->stock = 0; 
        $crudproduct->brand = $request->input('brand');
        $crudproduct->category_id = $request->input('category_id');
        $crudproduct->save();
    
        // Crear un registro en la tabla pivote con las unidades introducidas
        $units = $request->input('units') ?? 0; // Si units es null, asignar 0
        $crudproduct->users()->attach(auth()->user()->id, [
            'date' => now(),
            'units' => $units,
            'old_stock' => 0 // El stock antiguo es 0 ya que es un producto nuevo
        ]);
    
        // Actualizar el stock del producto
        $crudproduct->stock += $units;
        $crudproduct->save();
    
        return redirect()->route('crudproducts.index')->with('success', 'Producto creado correctamente.');
    }

    /**
     * Display the specified resource.
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $crudproduct = Product::findOrFail($id);
        $categories = Category::all(); // Obtener todas las categorías
        return view('crudproducts.edit', ['crudproduct' => $crudproduct, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CrudProductRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CrudProductRequest $request, $id)
    {
        $crudproduct = Product::findOrFail($id);
        
        // Procesar la nueva imagen si se proporciona
        if ($request->hasFile('new_image')) {
            $image = $request->file('new_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('images', $imageName, 'public');
    
            // Eliminar la imagen anterior si existe y no es la predeterminada
            if ($crudproduct->image !== 'default-image.jpg' && Storage::disk('public')->exists($crudproduct->image)) {
                Storage::disk('public')->delete($crudproduct->image);
            }
    
            $crudproduct->image = $imagePath;
        }
    
        // Actualizar los demás campos del producto
        $crudproduct->name = $request->input('name');
        $crudproduct->description = $request->input('description');
        $crudproduct->price = $request->input('price');
        $crudproduct->brand = $request->input('brand');
        $crudproduct->category_id = $request->input('category_id');
    
        // Obtener el stock actual antes de actualizar
        $oldStock = $crudproduct->stock;
    
        // Sumar las unidades proporcionadas al stock actual del producto
        $unitsToAdd = $request->input('units') ?? 0; // Si units es null, asignar 0
        $crudproduct->stock += $unitsToAdd;
    
        // Guardar el producto actualizado
        $crudproduct->save();
    
        // Crear un registro en la tabla pivote con las unidades introducidas
        $crudproduct->users()->attach(auth()->user()->id, [
            'date' => now(),
            'units' => $unitsToAdd,
            'old_stock' => $oldStock // El stock antiguo es el valor antes de la actualización
        ]);
    
        return redirect()->route('crudproducts.index')->with('success', 'Producto actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
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
