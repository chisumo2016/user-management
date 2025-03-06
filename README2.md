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
