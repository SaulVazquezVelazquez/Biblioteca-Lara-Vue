<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function __construct()
    {
        #De esta forma protegemos las rutas dependiendo el tipo de rol que este tenga asignado
        $this->middleware('can:admin.roles.create')->only('index');
        $this->middleware('can:admin.roles.create')->only('edit','update');
    }

    public function index()
    {
        $roles = Role::all();

        return view('admin.roles.index',compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();

        return view('admin.roles.create',compact('permissions'));

    }

    public function store(Request $request)
    {
        // $role = Role::create($request->all());

        $role = Role::create(['name' => $request->name]);

        $role->permissions()->sync($request->permissions);

        return redirect()->route('admin.roles.index',$role)->with('rolesS','Creado corectamente');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();

        return view('admin.roles.edit',compact(['role','permissions']));
    }

    public function update(Request $request, Role $role)
    {
        $role->update($request->all());

        $role->permissions()->sync($request->permissions);

        return redirect()->route('admin.roles.edit',$role)->with('rolesU','Update Success');
    }

    public function destroy(Role $role)
    {
        
        $role->delete();

        return redirect()->route('admin.roles.index')->with('rolesD','Delete Success');
    }
}
