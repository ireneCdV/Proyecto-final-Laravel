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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $crudcategories= Category::all();
        return view('crudcategories.index', ['crudcategories'=>$crudcategories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('crudcategories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CrudCategoryRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CrudCategoryRequest $request)
    {
        $crudcategory = new Category;
        $crudcategory->title = $request->input('title');
        $crudcategory->save();

        // Almacena la relación en la tabla pivot user_category
        DB::table('user_category')->insert([
            'user_id' => auth()->id(), // ID del usuario que ha creado la categoría
            'category_id' => $crudcategory->id // ID de la categoría recién creada
        ]);

        return redirect()->route('crudcategories.index');
    }

    /**
     * Display the specified resource.
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
     * Show the form for editing the specified resource.
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
     * Update the specified resource in storage.
     *
     * @param  CrudCategoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CrudCategoryRequest $request, $id)
    {
        $crudcategory = Category::findOrFail($id);
        
        // Guarda los cambios en la categoría
        $crudcategory->title = $request->input('title');
        $crudcategory->save();

        // Inserta un nuevo registro en la tabla pivot user_category
        DB::table('user_category')->insert([
            'user_id' => auth()->id(), // ID del usuario que ha actualizado la categoría
            'category_id' => $crudcategory->id // ID de la categoría actualizada
        ]);

        return redirect()->route('crudcategories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $crudcategory = Category::findOrFail($id);
        
        // Inserta un nuevo registro en la tabla pivot user_category para la eliminación
        DB::table('user_category')->insert([
            'user_id' => auth()->id(), // ID del usuario que ha eliminado la categoría
            'category_id' => $crudcategory->id // ID de la categoría eliminada
        ]);

        // Elimina la categoría
        $crudcategory->delete();

        return redirect()->route('crudcategories.index');
    }
}
