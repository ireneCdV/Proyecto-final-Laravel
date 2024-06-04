<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\CrudCategory;
use App\Http\Requests\CrudCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CrudCategoriesController extends Controller
{
    /**
     * Muestra una lista de recursos.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $crudcategories= Category::all();
        return view('crudcategories.index', ['crudcategories'=>$crudcategories]);
    }

    /**
     * Muestra el formulario para crear un nuevo recurso.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('crudcategories.create');
    }

    /**
     * Almacena un recurso recién creado en el almacenamiento.
     *
     * @param  CrudCategoryRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CrudCategoryRequest $request)
    {
        $crudcategory = new Category;
        $crudcategory->title = $request->input('title');
        $crudcategory->save();

        DB::table('user_category')->insert([
            'user_id' => auth()->id(), 
            'category_id' => $crudcategory->id 
        ]);

        return redirect()->route('crudcategories.index');
    }

    /**
     * Muestra el recurso especificado.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $crudcategory = Category::findOrFail($id);
        return view('crudcategories.show',['crudcategory'=>$crudcategory]);
    }

    /**
     * Muestra el formulario para editar el recurso especificado.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $crudcategory = Category::findOrFail($id);
        return view('crudcategories.edit',['crudcategory'=>$crudcategory]);
    }

    /**
     * Actualiza el recurso especificado en el almacenamiento.
     *
     * @param  CrudCategoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CrudCategoryRequest $request, $id)
    {
        $crudcategory = Category::findOrFail($id);
        
        $crudcategory->title = $request->input('title');
        $crudcategory->save();

        DB::table('user_category')->insert([
            'user_id' => auth()->id(), 
            'category_id' => $crudcategory->id 
        ]);

        return redirect()->route('crudcategories.index');
    }

    /**
     * Elimina el recurso especificado del almacenamiento.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $crudcategory = Category::findOrFail($id);
        
        DB::table('user_category')->insert([
            'user_id' => auth()->id(), 
            'category_id' => $crudcategory->id 
        ]);

        $crudcategory->delete();

        return redirect()->route('crudcategories.index');
    }
}
