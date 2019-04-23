<?php

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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::resource('addresses', 'AddressController');
Route::resource('authors', 'AuthorController');
Route::resource('books', 'BookController');
Route::resource('booklenders', 'BooklenderController');
Route::resource('categories', 'CategoryController');
Route::resource('genders', 'GenderController');
Route::resource('lenders', 'LenderController');
Route::resource('publishers', 'PublisherController');
Route::resource('staffs', 'StaffController');
Route::resource('users', 'UserController');
