<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\CrudAdmin;
use App\Http\Requests\CrudAdminRequest;
use App\Models\User;

class CrudAdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
{
    // Filtrar solo los usuarios que tengan cod_admin lleno
    $crudadmins = User::whereNotNull('cod_admin')->get();
    
    return view('crudadmins.index', ['crudadmins' => $crudadmins]);
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('crudadmins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CrudAdminRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CrudAdminRequest $request)
    {
        $crudadmin = new User;
		$crudadmin->name = $request->input('name');
		$crudadmin->surname = $request->input('surname');
		$crudadmin->phone = $request->input('phone');
		$crudadmin->address = $request->input('address');
		$crudadmin->dni = $request->input('dni');
		$crudadmin->email = $request->input('email');
		$crudadmin->password = $request->input('password');
		$crudadmin->cod_admin = $request->input('cod_admin');
        $crudadmin->save();

        return to_route('crudadmins.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $crudadmin = User::findOrFail($id);
        return view('crudadmins.show',['crudadmin'=>$crudadmin]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $crudadmin = User::findOrFail($id);
        return view('crudadmins.edit',['crudadmin'=>$crudadmin]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CrudAdminRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CrudAdminRequest $request, $id)
    {
        $crudadmin = User::findOrFail($id);
		$crudadmin->name = $request->input('name');
		$crudadmin->surname = $request->input('surname');
		$crudadmin->phone = $request->input('phone');
		$crudadmin->address = $request->input('address');
		$crudadmin->dni = $request->input('dni');
		$crudadmin->email = $request->input('email');
		$crudadmin->password = $request->input('password');
		$crudadmin->cod_admin = $request->input('cod_admin');
        $crudadmin->save();

        return to_route('crudadmins.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        // Obtener el administrador autenticado
        $admin = auth()->user();

        // Verificar el código de administrador proporcionado
        if ($request->input('cod_admin') !== $admin->cod_admin) {
            return redirect()->route('crudadmins.index')->with('error', 'Código de administrador incorrecto.');
        }

        // Eliminar el administrador
        $crudadmin = User::findOrFail($id);
        $crudadmin->delete();

        return redirect()->route('crudadmins.index')->with('success', 'Administrador eliminado correctamente.');
    }
}
