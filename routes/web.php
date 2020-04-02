<?php

use Illuminate\Support\Facades\Route;

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
    return view('sections.employees');
})->name('employee.index');

Route::get('/departments', function () {
    return view('sections.departments');
})->name('department.index');

Route::get('employee/{id}', 'EmployeeController@showWeb')->name('employee.show');
Route::get('department/create', 'DepartmentController@createWeb')->name('department.create');
Route::get('department/{id}', 'DepartmentController@showWeb')->name('department.show');
Route::get('department/{id}/edit', 'DepartmentController@editWeb')->name('department.edit');
