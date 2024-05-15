<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\CrudCategory;
use App\Http\Requests\CrudCategoryRequest;
use App\Models\Category;

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

        return to_route('crudcategories.index');
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
		$crudcategory->title = $request->input('title');
        $crudcategory->save();

        return to_route('crudcategories.index');
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
        $crudcategory->delete();

        return to_route('crudcategories.index');
    }
}
