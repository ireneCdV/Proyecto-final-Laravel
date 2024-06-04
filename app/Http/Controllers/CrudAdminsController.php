<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\CrudAdminRequest;
use App\Models\User;

class CrudAdminsController extends Controller
{
    /**
     * Muestra una lista de recursos.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $crudadmins = User::whereNotNull('cod_admin')->get();
        
        return view('crudadmins.index', ['crudadmins' => $crudadmins]);
    }

    /**
     * Muestra el formulario para crear un nuevo recurso.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('crudadmins.create');
    }

    /**
     * Almacena un recurso recién creado en el almacenamiento.
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
     * Muestra el recurso especificado.
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
     * Muestra el formulario para editar el recurso especificado.
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
     * Actualiza el recurso especificado en el almacenamiento.
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
     * Elimina el recurso especificado del almacenamiento.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        $admin = auth()->user();

        if ($request->input('cod_admin') !== $admin->cod_admin) {
            return redirect()->route('crudadmins.index')->with('error', 'Código de administrador incorrecto.');
        }

        $crudadmin = User::findOrFail($id);
        $crudadmin->delete();

        return redirect()->route('crudadmins.index')->with('success', 'Administrador eliminado correctamente.');
    }
}
