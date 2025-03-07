<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [

            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('view-user'), only:['index']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('create-user'), only:['create','store']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('update-user'), only:['update','edit']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('delete-user'), only:['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users')    );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //$roles = Role::get();
        $roles = Role::pluck('name', 'name')->all(); //associative array
        return view('admin.user.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|max:20',
            'roles' => 'required',
        ]);

        $user = User::create([
             'name' => $request->name,
             'email' => $request->email,
             'password' => Hash::make($request->password),
        ]);

        $user->syncRoles($request->roles); //['writer', 'admin']

        return redirect()->route('user.index')->with('success', 'User created successfully with roles.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'name')->all(); //associative array
        $userRoles  = $user->roles->pluck('name', 'name')->all();  // doc $user->roles

        return view('admin.user.edit', compact('user',  'roles' ,'userRoles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:6|max:20',
            'roles' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        if (!empty($request->password)) {
            //$data['password'] = Hash::make($request->password);  //+=
            $data += [
                'password' => Hash::make($request->password),
            ];
        }

        $user->update($data);

        //Update the Roles
        $user->syncRoles($request->roles);

        return redirect()->route('user.index')->with('success', 'User updated successfully with roles.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index')->with('success', 'User deleted successfully with roles.');
    }
}
