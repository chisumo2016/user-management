# LARAVEL 12 ROLES AND PERMISSION 
    https://developer.intacct.com/entity-relationship-diagrams/users-roles-groups-permissions/
    https://laraveldaily.com/lesson/laravel-vue-inertia-food-delivery/users-roles-permissions
    https://github.com/spatie/laravel-permission
    
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


    Add Pages on side bar
    
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

# Create User  By Admin  and  Assign Roles
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

# 
    
