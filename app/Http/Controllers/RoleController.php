<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\RoleStoreRequest;
use App\Http\Requests\Admin\RoleUpdateRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
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
}
