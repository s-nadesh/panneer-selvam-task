<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use App\DataTables\RoleDataTable;

use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(RoleDataTable $datatable)
    {
        
        return $datatable->render('roles.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all()->groupBy(function ($perm) {
            return explode('.', $perm->name)[0]; // group by module
        });

        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleStoreRequest $request)
    {
    
        $role = Role::create([
            'name' => $request->name,
        ]);
        
        if($request->permissions){
            $role->syncPermissions($request->permissions);
        }

        return redirect()->route('roles.index')->with('success','roles added succesfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all()->groupBy(function ($perm) {
            return explode('.', $perm->name)[0]; // group by module
        });

        $rolepermissions = $role->permissions->pluck('name')->toArray();

        return view('roles.edit', compact('role', 'permissions','rolepermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleUpdateRequest $request, Role $role)
    {

        $role->update([
            'name' => $request->name,
        ]);

        $role->syncPermissions($request->permissions ?? []);

        return redirect()->route('roles.index')->with('success', 'updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        if ($role->users()->exists()) {
            return redirect()
                ->back()
                ->with('error', 'Cannot delete Role. It is assigned to User.');
        }
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Roles deleted successfully'); 
    }
}
