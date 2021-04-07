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

//Route::get('/', function () {
    //return view('welcome');
//});
//Route::get('view', 'Front\UserController@getIndex');
//Route::get('landing', 'Front\UserController@getLanding');



//Route::get('/test1', function () {
// return 'welcome';
//});

//route parameters

//Route::get('/test2/{id}', function ($id) {
//return $id;
//});

//Route::get('/test3/{id?}', function () {
//return 'welcome';
//});
//-------------------------------------------
//route name

//Route::get('/show number/{id}', function ($id) {
//return $id;
//})->name('a');

//Route::get('/show string/{id?}', function () {
//return 'welcome';
//})->name('b');

/*Route::namespace('Front')->group(function(){
    // On ne peut appeler que les fonctions dans Front
    Route::get('/users', 'UserController@showAdminName');
});*/

/*Route::prefix('users')->groupe(function(){
    Route::get('show', 'UserController@showAdminName');
    Route::get('delete', 'UserController@showAdminName');
    Route::get('edit', 'UserController@showAdminName');
    Route::get('update', 'UserController@showAdminName');

});*/

//Meme chose =>
/*
Route::group(['prefix' => 'users', 'middleware' => 'auth'], function(){
    // set of routes
    Route::get('/', function(){
        return 'Work';
        //middleware necessite un login et mot de passe
    });


    Route::get('show', 'UserController@showAdminName');
    Route::get('delete', 'UserController@showAdminName');
    Route::get('edit', 'UserController@showAdminName');
    Route::get('update', 'UserController@showAdminName');

});
*/


//Route::group(['namespace' => 'Admin' ], function(){

    //Route::get('second1', 'SecondController@showString1') ;
    //Route::get('second2', 'SecondController@showString2');
   // Route::get('second3', 'SecondController@showString3') ;
   // Route::get('second4', 'SecondController@showString4') ;


//});

//Route::get('login', function(){

    //return 'Must be login to access';
//})->name('login');

//Route::resource('news', 'NewsController');

Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');


Route::get('/', 'HomeController@getWelcome');