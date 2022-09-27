<?php

use App\Models\Healthyhistory;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\UnitsController;
use App\Http\Controllers\StocksController;
use App\Http\Controllers\AnimalsController;
use App\Http\Controllers\GendersController;
use App\Http\Controllers\BincardsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VetdoctorsController;
use App\Http\Controllers\StaffmembersController;
use App\Http\Controllers\AnimalclassesController;
use App\Http\Controllers\HealthyhistoriesController;
use App\Http\Controllers\Superadmin\IndexController;
use App\Http\Controllers\Superadmin\RolesController;
use App\Http\Controllers\Superadmin\UsersController;
use App\Http\Controllers\Superadmin\PermissionsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// User Role Permissions Route
Route::middleware(['auth', 'role:SuperAdmin'])
    ->name('superadmin.')
    ->prefix('superadmin')
    ->group(function () {
        Route::get('/', [IndexController::class, 'index'])->name('index');
        Route::resource('/roles', RolesController::class);
        Route::post('/roles/{id}/permissions', [RolesController::class, 'grantPermission'])->name('roles.grantPermission');
        Route::delete('/roles/{roleid}/permissions/{permissionid}', [RolesController::class, 'revokePermission'])->name('roles.revokePermission');

        Route::resource('/permissions', PermissionsController::class);
        Route::post('/permissions/{id}/roles', [PermissionsController::class, 'assignRole'])->name('permissions.assignRole');
        Route::delete('/permissions/{permissionid}/roles/{roleid}', [PermissionsController::class, 'removeRole'])->name('permissions.removeRole');

        Route::get('/users', [UsersController::class, 'index'])->name('users.index');
        // Route::get('/users/create', [UsersController::class, 'create'])->name('users.create');
        // Route::post('/users', [UsersController::class, 'store'])->name('users.store');
        Route::get('/users/{id}', [UsersController::class, 'show'])->name('users.roles');
        Route::post('/users/{userid}/roles', [UsersController::class, 'assignRole'])->name('users.assignRole');
        Route::delete('/users/{userid}/roles/{roleid}', [UsersController::class, 'removeRole'])->name('users.removeRole');

        Route::post('/users/{userid}/permissions', [UsersController::class, 'grantPermission'])->name('users.grantPermission');
        Route::delete('/users/{userid}/permissions/{permissionid}', [UsersController::class, 'revokePermission'])->name('users.revokePermission');


        // Route::get('/users{id}/edit', [UsersController::class, 'edit'])->name('users.edit');
        // Route::put('/users{id}', [UsersController::class, 'update'])->name('users.update');
        Route::delete('/users{id}', [UsersController::class, 'destroy'])->name('users.destroy');
    });

require __DIR__ . '/auth.php';

Route::get('send', [DashboardController::class, 'sendNotification']);

// Animals Routes
Route::prefix('/animals')->group(function () {
    //List Animal Classes
    Route::get('/', [AnimalsController::class, 'index'])->name('animal.index');
    //Display create Animals form
    Route::get('/create', [AnimalsController::class, 'create'])->name('animal.create');
    //Save New Animals records into the database
    Route::post('/', [AnimalsController::class, 'store'])->name('animal.store');
    //Show Animal details
    Route::get('/{id}', [AnimalsController::class, 'show'])->where('id', '[0-9]+')->name('animal.show');
    //Download Healthy Report in PDF
    Route::get('/downloadPDF/{id}', [AnimalsController::class, 'downloadPDF'])->where('id', '[0-9]+')->name('animal.downloadPDF');
    //Display edit Animal form
    Route::get('/{id}/edit', [AnimalsController::class, 'edit'])->name('animal.edit');
    //Save edited Animal record
    Route::put('/{id}', [AnimalsController::class, 'update'])->name('animal.update');
    // Delete Selected Animal Record
    Route::delete('/{id}', [AnimalsController::class, 'destroy'])->name('animal.destroy');
});

// Animal Class Routes
Route::prefix('/animalclasses')->group(function () {
    //List Animal Classes
    Route::get('/', [AnimalclassesController::class, 'index'])->name('animalclass.index');
    //Display create Animal Class form
    Route::get('/create', [AnimalclassesController::class, 'create'])->name('animalclass.create');
    //Save New Animal Class records into the database
    Route::post('/', [AnimalclassesController::class, 'store'])->name('animalclass.store');
    //Show Animal Class details
    Route::get('/{id}', [AnimalclassesController::class, 'show'])->name('animalclass.show');
    //Display edit Animal Class form
    Route::get('/{id}/edit', [AnimalclassesController::class, 'edit'])->name('animalclass.edit');
    //Save edited Animal Class record
    Route::put('/{id}', [AnimalclassesController::class, 'update'])->name('animalclass.update');
    // Delete Selected Animal Class Record
    Route::delete('/{id}', [AnimalclassesController::class, 'destroy'])->name('animalclass.destroy');
});

// Animal Class Routes
Route::prefix('/bincards')->group(function () {
    //List Animal Classes
    Route::get('/', [BincardsController::class, 'index'])->name('bincard.index');
    //Download PDF
    Route::get('/downloadPDF', [BincardsController::class, 'downloadPDF'])->name('bincard.downloadPDF');

    //Display create Animal Class form
    // Route::get('/create', [AnimalclassesController::class, 'create'])->name('animalclass.create');
    // //Save New Animal Class records into the database
    // Route::post('/', [AnimalclassesController::class, 'store'])->name('animalclass.store');
    // //Show Animal Class details
    // Route::get('/{id}', [AnimalclassesController::class, 'show'])->name('animalclass.show');
    // //Display edit Animal Class form
    // Route::get('/{id}/edit', [AnimalclassesController::class, 'edit'])->name('animalclass.edit');
    // //Save edited Animal Class record
    // Route::put('/{id}', [AnimalclassesController::class, 'update'])->name('animalclass.update');
    // // Delete Selected Animal Class Record
    // Route::delete('/{id}', [AnimalclassesController::class, 'destroy'])->name('animalclass.destroy');
});

//dashboards Routes
// Route::get('/', [DashboardsController::class, 'index'])->name('Dashboard');

// Genders routes
Route::prefix('/genders')->group(function () {
    //List Genders
    Route::get('/', [GendersController::class, 'index'])->name('gender.index');
    //Display create Gender form
    Route::get('/create', [GendersController::class, 'create'])->name('gender.create');
    //Save New Gender records into the database
    Route::post('/', [GendersController::class, 'store'])->name('gender.store');
    //Show Gender details
    Route::get('/{id}', [GendersController::class, 'show'])->name('gender.show');
    //Display edit Gender form
    Route::get('/{id}/edit', [GendersController::class, 'edit'])->name('gender.edit');
    //Save edited Gender record
    Route::put('/{id}', [GendersController::class, 'update'])->name('gender.update');
    // Delete Selected Gender Record
    Route::delete('/{id}', [GendersController::class, 'destroy'])->name('gender.destroy');
});

// Healthyhistories routes
Route::prefix('/healthyhistories')->group(function () {
    //List Healthy Histories
    Route::get('/', [HealthyhistoriesController::class, 'index'])->name('healthyhistory.index');
    //Download PDF
    Route::get('/downloadPDF', [HealthyhistoriesController::class, 'downloadPDF'])->name('healthyhistory.downloadPDF');
    //Display create Healthy Hisotry form
    Route::get('/create', [HealthyhistoriesController::class, 'create'])->name('healthyhistory.create');
    //Save New Healthy Hsitory records into the database
    Route::post('/', [HealthyhistoriesController::class, 'store'])->name('healthyhistory.store');
    //Show Healthy History details
    Route::get('/{id}', [HealthyhistoriesController::class, 'show'])->where(['id', '[0-9]+'])->name('healthyhistory.show');
    //Display edit Healthy History form
    Route::get('/{id}/edit', [HealthyhistoriesController::class, 'edit'])->name('healthyhistory.edit');
    //Save edited Healthy History record
    Route::put('/{id}', [HealthyhistoriesController::class, 'update'])->name('healthyhistory.update');
    // Delete Seleted Healthy Hisotry Record
    Route::delete('/{id}', [HealthyhistoriesController::class, 'destroy'])->name('healthyhistory.destroy');
});

// Stores routes
Route::prefix('/stocks')->group(function () {
    //List Stocks
    Route::get('/', [StocksController::class, 'index'])->name('stock.index');
    //Display create Store form
    Route::get('/create', [StocksController::class, 'create'])->name('stock.create');
    //Save New Stock records into the database
    Route::post('/', [StocksController::class, 'store'])->name('stock.store');
    //Show Stock details
    Route::get('/{id}', [StocksController::class, 'show'])->name('stock.show');
    //Display edit Stock form
    Route::get('/{id}/edit', [StocksController::class, 'edit'])->name('stock.edit');
    //Save edited Stock record
    Route::put('/{id}', [StocksController::class, 'update'])->name('stock.update');
    // Delete Selected Stock Reocord
    Route::delete('/{id}', [StocksController::class, 'destroy'])->name('stock.destroy');
});

// Products routes
Route::prefix('/products')->group(function () {
    //List Products
    Route::get('/', [ProductsController::class, 'index'])->name('product.index');
    //Display create Product form
    Route::get('/create', [ProductsController::class, 'create'])->name('product.create');
    //Save New Product records into the database
    Route::post('/', [ProductsController::class, 'store'])->name('product.store');
    //Show Product details
    Route::get('/{id}', [ProductsController::class, 'show'])->name('product.show');
    //Display edit Product form
    Route::get('/{id}/edit', [ProductsController::class, 'edit'])->name('product.edit');
    //Save edited Product record
    Route::put('/{id}', [ProductsController::class, 'update'])->name('product.update');
    // Delete Selected Product Reocord
    Route::delete('/{id}', [ProductsController::class, 'destroy'])->name('product.destroy');
});

// Sales routes
Route::prefix('/sales')->group(function () {
    //List Sales
    Route::get('/', [SalesController::class, 'index'])->name('sale.index');
    //Display create Sale form
    Route::get('/create', [SalesController::class, 'create'])->name('sale.create');
    //Save New Sale records into the database
    Route::post('/', [SalesController::class, 'store'])->name('sale.store');
    //Show Sale details
    Route::get('/{id}', [SalesController::class, 'show'])->where('id', '[0-9]+')->name('sale.show');
    //Download Sales PDF
    Route::get('/downloadPDF', [SalesController::class, 'downloadPDF'])->name('sale.downloadPDF');
    // Route::get('/downloadPDF/{array}', [SalesController::class, 'downloadPDF'])->name('sale.downloadPDF');
    // Route::get('/downloadPDF/{id}', [SalesController::class, 'downloadPDF'])->name('sale.downloadPDF');
    //Show Sale details
    Route::get('/{id}', [SalesController::class, 'show'])->where('id', '[0-9]+')->name('sale.show');
    //Display edit Sale form
    Route::get('/{id}/edit', [SalesController::class, 'edit'])->name('sale.edit');
    //Save edited Sale record
    Route::put('/{id}', [SalesController::class, 'update'])->name('sale.update');
    //Delete Selected Sales Record
    Route::delete('/{id}', [SalesController::class, 'destroy'])->name('sale.destroy');
});

// Staffmembers routes
Route::prefix('/staffmembers')->group(function () {
    //List staffmembers
    Route::get('/', [StaffmembersController::class, 'index'])->name('staffmember.index');
    //Display create staffmember form
    Route::get('/create', [StaffmembersController::class, 'create'])->name('staffmember.create');
    //Save New staffmember records into the database
    Route::post('/', [StaffmembersController::class, 'store'])->name('staffmember.store');
    //Show staffmember details
    Route::get('/{id}', [StaffmembersController::class, 'show'])->name('staffmember.show');
    //Display edit staffmember form
    Route::get('/{id}/edit', [StaffmembersController::class, 'edit'])->name('staffmember.edit');
    //Save edited staffmember record
    Route::put('/{id}', [StaffmembersController::class, 'update'])->name('staffmember.update');
    //Delete Selected staffmembers Record
    Route::delete('/{id}', [StaffmembersController::class, 'destroy'])->name('staffmember.destroy');
});

// Units routes
Route::prefix('/units')->group(function () {
    //List units
    Route::get('/', [UnitsController::class, 'index'])->name('unit.index');
    //Display create unit form
    Route::get('/create', [UnitsController::class, 'create'])->name('unit.create');
    //Save New unit records into the database
    Route::post('/', [UnitsController::class, 'store'])->name('unit.store');
    //Show unit details
    Route::get('/{id}', [UnitsController::class, 'show'])->name('unit.show');
    //Display edit unit form
    Route::get('/{id}/edit', [UnitsController::class, 'edit'])->name('unit.edit');
    //Save edited unit record
    Route::put('/{id}', [UnitsController::class, 'update'])->name('unit.update');
    //Delete Selected units Record
    Route::delete('/{id}', [UnitsController::class, 'destroy'])->name('unit.destroy');
});


// Vetdoctors routes
Route::prefix('/vetdoctors')->group(function () {
    //List vetdoctors
    Route::get('/', [VetdoctorsController::class, 'index'])->name('vetdoctor.index');
    //Display create vetdoctor form
    Route::get('/create', [VetdoctorsController::class, 'create'])->name('vetdoctor.create');
    //Save New vetdoctor records into the database
    Route::post('/', [VetdoctorsController::class, 'store'])->name('vetdoctor.store');
    //Show vetdoctor details
    Route::get('/{id}', [VetdoctorsController::class, 'show'])->name('vetdoctor.show');
    //Display edit vetdoctor form
    Route::get('/{id}/edit', [VetdoctorsController::class, 'edit'])->name('vetdoctor.edit');
    //Save edited vetdoctor record
    Route::put('/{id}', [VetdoctorsController::class, 'update'])->name('vetdoctor.update');
    //Delete Selected vetdoctors Record
    Route::delete('/{id}', [VetdoctorsController::class, 'destroy'])->name('vetdoctor.destroy');
});
