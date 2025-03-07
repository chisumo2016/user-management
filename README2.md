# LARAVEL 12 ROLES AND PERMISSION 
    https://developer.intacct.com/entity-relationship-diagrams/users-roles-groups-permissions/
    https://laraveldaily.com/lesson/laravel-vue-inertia-food-delivery/users-roles-permissions
    https://github.com/spatie/laravel-permission
    https://www.youtube.com/watch?v=uUzym4XxXlc

    ADMIN  - admin role
                        create  the post
                        delete  the post
                        edot  the post
    USER   - user role
                        - See the  testd
                        - See the  project
    Manager  - employer role
                            - See the  dashboard


    1:Permission
    2:Role



# Introduction  and Laravel 12 Install
# Setup Admin Themes
    Remove Public URL, Database Connection & Download Admin Themes 
        Remove code and paste in root
        Theme Adminn
            https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
# Login - Admin and User (Authentication)
        Main  to create the login cconcept
        Create  the AAuth  Controller via terminal
        php artisan make:controller Auth/LoginController
        UI - email and password

        Find
            assests/
            {{ asset('')}}/assets/

        One  the user is logged will be redirectted to dashboard 

# Admin Themes Setup 
    php artisan make:controller Admin/DashboardController

# Middleware 
    Restric the  access on accessing the url iif ur not login
    php artisan make:middleware  AdminUserMiddleware
    Register  middleware
    Write  the logic in middlware in  class
    Add the middlware in web route

# Roles - CRUD 
    php artisan migrate:rollback --step=1
    php artisan make:request  Admin/RoleStoreRequest
    php artisan make:request  Admin/RoleUpdateRequest
    Create By Admin
    Permission Setup Inside Roles

# Active Class in Menu
    to use the segments to show the active class
               <span>Roles - {{ Request::segment(1) }} </span>


    Add Pages on side bar and  Views Page 
    
        Dashboardd
        User
        Roles
        Category
        Sub Category
        Product
        Setting
        Logout


    Add routes for all pages in web routes

    Make views for each pages
        php artisan make:view users.index

#   Role based Permissions
    what permission is available based on role eeg admin, user , employer
       Dashboard

        User
            add-user
            edit-user
            delete-user

        Roles
            add-role
            edit-role
            delete-role

        Category
            add-category
            edit-category
            delete-category

        Sub Category
            add-Sub Category
            edit-Sub Category
            delete-USub Category

        Product
            add-product
            edit-product
            delete-product

        Setting
        Logout

# Adding the permission to the ROLE AS MAIN CONCEPT


# Permission wise Show Menu
# Access Permission Wise Page  eg links


# We can create  some pages  for permission (restriction)

    Dashboardd
    User
    Roles
    Category
    Sub Category
    Product
    Setting
    Logout

    NB: We pages to show permission

#  Assign Permission to Role  (Role_has_permission) find in database
        permission_id             role_id
      Role: Super-admin
                .create-role
                .view-role
                .edit-role
                .delete-role


     Call to a member function syncPermissions() on string
        This error occurs because $role is a string (ID) instead of an actual Role model instance.

     Call to undefined method App\Models\Role::syncPermissions()
        Solution to add  trait in Role Model    use HasPermissions;

     - Create a new file called resources/views/admin/role/add-permission.blade.php
     - Add the route  URRL 
                 Route::get('admin/role/{role}/give-permission', [RoleController::class, 'givePermission'])->name('role.give-permission');
                 Route::put('admin/role/{role}/give-permission', [RoleController::class, 'givePermissionToRole'])->name('role.update-permission');
     - Add logic to RoleController
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

# Create the  USER  CRUD operations 
    Fetch the user with their roles
    Add new user and assign the roles to particulr user
    Edit/Update user and assign the roles to particulr user
    Assign role to a particcular user.
       v<option value="{{ $role->id }}">{{$role->name}}</option>

    model_has_roles (user_has_roles)

    Edit the  uuser with particular roles

# USAGE OF ROLES AND PERMISSIONS INTO OUR APPLICATIONS

    How to use, manage and protect routes with Middleware using roles & permissions.
    Route group middlware, Route middleware, Middleware via Controller.


    We will see how to use these Roles and Permissionss to MANAGE  and PROTECT the routes in the Laravel application .

    So basically , PROTECTING ROUTES means when a user is  trying  to access a certain route , to which he doesnt have 
    permission, then we will not allow the user to access the route/page .

    For Example :

            If a user's ROLE is staff , he/she cannot delete the product .
            He can only create and update a produuct.
            He doesn't have PERMISSION to delete the  product reccord

    Protect our routes  and  check if its authenticcated

    These roles are given to particular user .

#  Custom Admin Middleware via Route.
        https://spatie.be/docs/laravel-permission/v6/basic-usage/middleware
     If the logged user is SUPER ADMIN he/she can accesss the following routes
            Route::group(['middleware' => 'useradmin'], function () {
                    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');
                    //Route::resource('roles', RoleController::class);
                
                    Route::get('admin/role', [RoleController::class, 'index'])->name('role.index');
                    Route::get('admin/role/create', [RoleController::class, 'create'])->name('role.create');
                    Route::post('admin/role', [RoleController::class, 'store'])->name('role.store');
                    Route::get('admin/role/{role}/edit', [RoleController::class, 'edit'])->name('role.edit');
                    Route::put('admin/role/{role}', [RoleController::class, 'update'])->name('role.update');
                    Route::delete('admin/role/{role}', [RoleController::class, 'destroy'])->name('role.destroy');
                
                    Route::get('admin/role/{role}/give-permission', [RoleController::class, 'givePermission'])->name('role.give-permission');
                    Route::put('admin/role/{role}/give-permission', [RoleController::class, 'givePermissionToRole'])->name('role.update-permission');
                
                
                    //Route::resource('permissions', PermissionController::class);
                
                    Route::get('admin/permissions', [PermissionController::class, 'index'])->name('permission.index');
                    Route::get('admin/permissions/create', [PermissionController::class, 'create'])->name('permission.create');
                    Route::post('admin/permissions', [PermissionController::class, 'store'])->name('permission.store');
                    Route::get('admin/permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('permission.edit');
                    Route::put('admin/permissions/{permission}', [PermissionController::class, 'update'])->name('permission.update');
                    Route::delete('admin/permissions/{permission}', [PermissionController::class, 'destroy'])->name('permission.destroy');
                
                    //Route::resource('users', UserController::class);
                
                    Route::get('admin/users', [UserController::class, 'index'])->name('user.index');
                    Route::get('admin/users/create', [UserController::class, 'create'])->name('user.create');
                    Route::post('admin/users', [UserController::class, 'store'])->name('user.store');
                    Route::get('admin/users/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
                    Route::put('admin/permissions/{user}', [UserController::class, 'update'])->name('user.update');
                    Route::delete('admin/users/{user}', [UserController::class, 'destroy'])->name('user.destroy');
                });

        
        Single permission
            Route::group(['middleware' => ['can:publish articles']], function () { ... });

            In Laravel 11 open /bootstrap/app.php and register them there:In Laravel 11 open /bootstrap/app.php and register them there:
                    ->withMiddleware(function (Middleware $middleware) {
                        $middleware->alias([
                            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
                            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
                            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
                        ]);
                    })

#    Using Middleware in Routes and Controllers
        After you have registered the aliases as shown above, you can use them in your Routes and Controllers much the same way you use any other middleware:

        # Routes
            Route::group(['middleware' => ['role:manager']], function () { ... });
            Route::group(['middleware' => ['permission:publish articles']], function () { ... });
            Route::group(['middleware' => ['role_or_permission:publish articles']], function () { ... });

        Protecting te route using ROLES AND PERMISSION
                Route::group(['middleware' => ['useradmin', 'role:super-admin|admin']], function () {
                        Route::delete('admin/role/{role}', [RoleController::class, 'destroy'])->name('role.destroy')->middleware('permission:delete-role');
                });
                
        Set the  permission to  a particular route .

        How can u add the middlware in resource  route ?
            Route::resource('users', UserController::class);
            In Controllers

                   public static function middleware(): array
                    {
                        return [
                
                
                           new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('update-role'), only:['update','edit']),
                            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('delete-role'), only:['destroy']),
                        ];
                    }
        
#  Blade Directives


        
    
        
