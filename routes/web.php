<?php

use App\Http\Controllers\Api\CityApiController;
use App\Http\Controllers\Backend\CityController;
use App\Http\Controllers\Backend\CountryController;
use App\Http\Controllers\Backend\EmployeeController;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\DepartmentController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|  
*/

Route::get('/', function () {
   
 return view('welcome');
});

Route::get('/h', function () {
    return "hello";     
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('users', UserController::class);
Route::post('/users/{user}/change-password',[UserController::class , 'updatepw'])->name('users.updatepw');
Route::resource('country', CountryController::class);
Route::get('/country/{country}/delete', [CountryController::class, 'destroy'])->name('country.delete');
Route::resource('city', CityController::class);
Route::get('/city/{city}/delete', [CityController::class, 'destroy'])->name('city.delete');
Route::resource('department',DepartmentController::class);
Route::get('/department/{department}/delete', [DepartmentController::class, 'destroy'])->name('department.delete');
Route::get('/employees/{employee}/delete', [EmployeeController::class, 'destroy'])->name('employees.delete');
Route::resource('employees',EmployeeController::class);
Route::get('/api/city/{country}', [CityApiController::class, 'get']);
Route::get('/a', [EmployeeController::class , 'export'])->name('employees.export');

