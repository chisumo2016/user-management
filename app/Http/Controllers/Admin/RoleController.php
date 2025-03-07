<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleStoreRequest;
use App\Http\Requests\Admin\RoleUpdateRequest;
use App\Models\Permission;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Spatie\Permission\Models\Role;

class RoleController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [


           new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('update-role'), only:['update','edit']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('delete-role'), only:['destroy']),
        ];
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return  view('admin.role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleStoreRequest  $request)
    {
        $validated = $request->validated();
        $validated['guard_name'] = $validated['guard_name'] ?? 'web';

        Role::create($validated);

        return redirect()
            ->route('role.index')
            ->with('success' , "Role created successfully");
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('admin.role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleUpdateRequest $request, Role $role)
    {
        //dd($request->route('permission'));
        $validated = $request->validated();

        $role->update($validated);

        return redirect()
            ->route('role.index')
            ->with('success' , "Role updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()
            ->route('role.index');

    }

    //Add permission
    public function givePermission(Role $role)
    {
        //$permissions = \Spatie\Permission\Models\Permission::all();
        //dd($permissions);

        $permissions = Permission::all(); //get
        $rolePermissions = \DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id' ,$role->id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        return view('admin.role.add-permission', compact('role', 'permissions','rolePermissions')); //key and value
    }

    public function givePermissionToRole(Request $request, Role $role) //$roleId
    {
        //dd($request->all(),  $role);
        $request->validate([
            'permission' => 'required|array',
        ]);

       // dd($request->permission);  //Check if the permissions are coming as an array

        // Retrieve the Role model using the ID
        //$role = Role::findOrFail($roleId);

        $role->syncPermissions($request->permission); //input checkbox

        return redirect()->back()->with('success' , "Permission added to Role successfully");

    }
}
