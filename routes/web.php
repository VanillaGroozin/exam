<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
}); 
// Route::get('/list', 'RecipiesController@list'); 
// Route::get('/add', 'RecipiesController@add'); 
// Route::get('/recipe', 'RecipiesController@recipe'); 

Route::get('Recipe/my', 'RecipiesController@my')->name("Recipe.my");
Route::resource('Recipe', 'RecipiesController');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

