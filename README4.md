# LARAVEL 12 RIGHT WAY 
    . Career Opportunity
    . Faster Development eg  MVP
    . Many Features 
        Command Line
        Command  Schedular
        Object Relational Mapping
        Complete Authentication System
        Authorization
        Notifications
        Automatic Testing
        Real Time Events
        DI container
        Templating Engine
        Queue System
        File System
        Database Migratiions
        Localiizaation
        Can be paired  with many front end techhnologies like react and vuejs

    Ecosystem and Tools
        Telescope
        Sanctum
        Horizon
        Breeze
        Jetstream
        Octane
        Inertia
        Cashier
        Sail
        Spark
        Prompts  
        Reverb
        Vapor
        Pulse
        Forge            
    Documentation and Simplicity


        Woorking with arrays

# Understanding Laravel Architecture
            1: public/index.php
            2: bootstrap/app.php

# Type  of Service  
            1: Service Container
            1: Service Provider
        NB: !=

# Artisan Commands 
        php artisan list
        php artisan list -h
        php artisan list -format-md
        php artisan route:list
        php artisan route
        php artisan list route
        php artisan list config
        php artisan config:cache -h
        php artisan route:list --except-vendor
        php artisan route:list --path=dashboard
         php artisan route:cache
        php artisan route:clear

# Laravel Tinker 
        php artisan tinker
            config('app.name')

# Laravel Config Files
    config/app.php
            php artisan tinker
                eg.
                    $_ENV 
                    config('app.name')
                    env('APP_NAME')
                    App::environment()
                    App::environment('local')
                    App::environment('staging')
                    App::environment(['staging' ,'production', 'local'])

# ROUTING 
    routes/web.php
            Route::match(['get', 'post'], StudentController::class);
            Route::any('/students', StudentController::class);

    Redirect
        Route::redirect('/students', 'dashboard');

    CACHE ROUTING
        php artisan route:cache
        php artisan route:clear


# ROUTING - { PARAMETER }
        Order Matter 
        Match the parameter name

        Route::get('transaction/{transactionId}', function ($transactionId) {
            return $transactionId;
        });

        Multiiple Parameter
         Route::get('transaction/{transactionId}/files/{files}', function ($transactionId,$files) {
            return $transactionId , $files;
        });

        Optional
             Route::get('report/{year}/{month?}', function ($year , $month=null) {
            return $year , $month;
        });

        Query String   - report/876/238/3


        Dependency  Injectionn ,
            
            Route::get('report/{reportId}', function (\Illuminate\Http\Request $request , $reportId) {
            $year = $request->get("year");
            $month = $request->get("month");
            
                return 'Generating report for' . $year . '-' . $month;
            });

        Pass the type
            Route::get('transaction/{transactionId}', function (int  $transactionId) {
            return $transactionId;
        });

        Pass wild ard

                Route::get('report/{reportId}', function (\Illuminate\Http\Request $request , int $reportId) {
                    $year = $request->get("year");
                    $month = $request->get("month");
                
                    return 'Generating report for' . $year . '-' . $month;
                })->where('year', '[0-9]+');
                     

        Pass an  Array
                 Route::get('report/{reportId}', function (\Illuminate\Http\Request $request , int $reportId) {
                    $year = $request->get("year");
                    $month = $request->get("month");
                
                    return 'Generating report for' . $year . '-' . $month;
                })->where(['reportId' => '[0-9]+' ,'reportsId' => '[0-9]+' ]);

        Global Parameters
            app/Providers/AppServiceProvider.php
            
                public function boot(): void
                {
                    Route::pattern('transactionId', '[0-9]+');
                    Route::pattern('fileId', '[0-9]+');
                }

                Route::get('report/{reportId}', function (\Illuminate\Http\Request $request , int $reportId) {
                    $year = $request->get("year");
                    $month = $request->get("month");
                
                    return 'Generating report for' . $year . '-' . $month;
                });

       WHERENUMMBER

            Route::get('report/{reportId}', function (\Illuminate\Http\Request $request , int $reportId) {
            $year = $request->get("year");
            $month = $request->get("month");
            
                return 'Generating report for' . $year . '-' . $month;
            })->whereNumber('reportId');

# CONTROLLERS 
        Delete the base controller 
            php artisan make:controller TransaactionController

        Single action controller
            php artisan make:controller ProcessController --invokable

# ROUTE GROUPS
     Group by  prefixes 
        Route::get('/transactions', [TransactionController::class, 'index'])->name('transaction.index');
        Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transaction.create');
        Route::get('/transactions/{transactionId}', [TransactionController::class, 'show'])->name('transaction.show');
        Route::post('/transactions', [TransactionController::class, 'store'])->name('transaction.store');

        Syntax :

            Route::prefix('transactions')->group(function () {
            
            });


        Route::prefix('transactions')->group(function () {
        Route::get('/', [TransactionController::class, 'index'])->name('transaction.index');
        Route::get('/create', [TransactionController::class, 'create'])->name('transaction.create');
        Route::get('/{transactionId}', [TransactionController::class, 'show'])->name('transaction.show');
        Route::post('/', [TransactionController::class, 'store'])->name('transaction.store');
        });

    Group by Controller

              Route::prefix('transactions')->group(function () {

                        /*Group by controller**/
                        Route::controller()->group(function () {
                            
                        });
            });

      Example
        /*Group by prefix**/
        Route::prefix('transactions')->group(function () {
        
            /*Group by controller**/
            Route::controller(TransactionController::class)->group(function () {
                Route::get('/',                 'index')->name('transaction.index');
                Route::get('/create',           'create')->name('transaction.create');
                Route::get('/{transactionId}',  'show')->name('transaction.show');
                Route::post('/',    'store')->name('transaction.store');
            });
        
        });

        Group by  Route Name
             /*Group by prefix**/
        Route::prefix('transactions')->group(function () {
        
            /*Group by controller**/
            Route::controller(TransactionController::class)->group(function () {
                Route::get('/',                 'index')->name('transaction.index');
                Route::get('/create',           'create')->name('transaction.create');
                Route::get('/{transactionId}',  'show')->name('transaction.show');
                Route::post('/',    'store')->name('transaction.store');
            });
        
        });

      Prefix the route name 

        /*Group by prefix**/
        Route::prefix('transactions')->group(function () {

                        /*Group by controller**/
                        Route::controller()->group(function () {
                                /*Group by route name **/
                            Route::name('transactions.')->group(function () {
                                
                            });
                        });
            });

        Example

                /*Group by prefix**/
            Route::prefix('transactions')->group(function () {
                /*Group by controller**/
                Route::controller(TransactionController::class)->group(function () {
                    /*Group by route name **/
                    Route::name('transactions.')->group(function () {
                        Route::get('/',                 'index')->name('index');
                        Route::get('/create',           'create')->name('create');
                        Route::get('/{transactionId}',  'show')->name('show');
                        Route::post('/transactions',    'store')->name('store');
                    });
                });
            });



        Improvement of the coode above

                    /*Group by route name , prefix **/
                    Route::name('transactions.')->prefix('transactions')->group(function () {
                        /*Group by Controller**/
                        Route::controller(TransactionController::class)->group(function () {
                        Route::get('/',                 'index')->name('index');
                        Route::get('/create',           'create')->name('create');
                        Route::get('/{transactionId}',  'show')->name('show');
                        Route::post('/transactions',    'store')->name('store');
                        });
                });


     When the application grow up , we need to move into separe  file 
            Create a  file routes/transactions.php
            Register them 
                bootstrap/app.php

                        then: function () {
                            /*Register our transaction**/
                            /*Group by route name , prefix **/
                            \Illuminate\Support\Facades\Route::prefix('transactions')
                                ->name('transactions.')
                                ->group(base_path('routes/transactions.php'));  //generate full path
                        }


# HOW  MIDDLEWARE  WORKS IN LARAVEL
    bootstrap/app.php
    Think middlware as series of filters or layers that requests must pass through before reaching your application.
    Sit in between your requests and controllers allowing you to inspect modify annd even stop requests based on certain criiterias
        eg bootstrap/app.php

             ->withMiddleware(function (Middleware $middleware) {
                 $middleware->alias([
                     'userAdmin' => \App\Http\Middleware\AdminUserMiddleware::class,
                     'isAdmin' => \App\Http\Middleware\AdminMiddleware::class,
        
                     'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
                     'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
                     'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
                 ]);
    })
        
            Types of arrays
                array_map
                array_values
                array_filter
                array_diff
                array_unique
                array_merge

    php artisan make:middleware  AssignRequestId
          Route::resource('admin/student', StudentController::class)->middleware(CheckUserRole::class);







            
























































                 
                    












        
    
        
