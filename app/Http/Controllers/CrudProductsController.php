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
        // Validar y procesar la imagen
        if ($request->hasFile('image')) {
            // Obtener el archivo de imagen del formulario
            $image = $request->file('image');
            
            // Generar un nombre único para la imagen
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            
            // Almacenar la imagen en el almacenamiento público
            $imagePath = $image->storeAs('images', $imageName, 'public');
        } else {
            // Si no se proporciona ninguna imagen, asignar un valor predeterminado o lanzar una excepción según tus necesidades
            // Aquí, supongamos que asignamos una imagen predeterminada
            $imagePath = 'default-image.jpg';
        }
    
        // Crear un nuevo producto con los datos del formulario y la ruta de la imagen
        $crudproduct = new Product;
        $crudproduct->image = $imagePath;
        $crudproduct->name = $request->input('name');
        $crudproduct->description = $request->input('description');
        $crudproduct->price = $request->input('price');
        $crudproduct->stock = $request->input('stock');
        $crudproduct->brand = $request->input('brand');
        $crudproduct->category_id = $request->input('category_id');
        $crudproduct->save();
    
        // Redirigir al usuario a la página de índice de productos o a cualquier otra página según tu flujo de la aplicación
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
    
        // Validar y procesar la imagen si se proporciona una nueva
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('images', $imageName, 'public');
    
            // Eliminar la imagen anterior si existe
            if ($crudproduct->image && Storage::exists($crudproduct->image)) {
                Storage::delete($crudproduct->image);
            }
    
            // Actualizar la ruta de la imagen en la base de datos
            $crudproduct->image = $imagePath;
        }
    
        // Actualizar los demás campos del producto
        $crudproduct->name = $request->input('name');
        $crudproduct->description = $request->input('description');
        $crudproduct->price = $request->input('price');
        $crudproduct->stock = $request->input('stock');
        $crudproduct->brand = $request->input('brand');
        $crudproduct->category_id = $request->input('category_id');
        $crudproduct->save();
    
        // Redirigir al usuario a la página de índice de productos o a cualquier otra página según tu flujo de la aplicación
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

        return to_route('crudproducts.index');
    }
}
