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


Route::get('/redirect/{service}', 'SocialController@redirect');

Route::get('/callback/{service}', 'SocialController@callback');

Route::get('fillable', 'CrudController@getOffers');


    //Route::get('store', 'CrudController@store');
Route::group(['prefix' => LaravelLocalization::setLocale(),
    'middleware' =>  ['localeSessionRedirect' , 'localizationRedirect' , 'localeViewPath']
    ], function(){

    Route::group(['prefix' => 'offers'], function(){
    Route::get('create', 'CrudController@create');
    Route::post('store', 'CrudController@store')-> name('offers.store');

    Route::get('edit/{offer_id}', 'CrudController@editOffer');
    Route::post('update/{offer_id}', 'CrudController@updateOffer')-> name('offers.update');
    Route::get('delete/{offer_id}', 'CrudController@deleteOffer')-> name('offers.delete');
    Route::get('all', 'CrudController@getAllOffers')->name('offers.all');
});

    Route::get('youtube', 'CrudController@getVideo');

});

########################### AJAX ############################



    Route::group(['prefix' => 'ajax_offers'], function () {

        Route::get('create', 'OfferController@create');
        Route::post('store', 'OfferController@store')->name('ajax.offers.store');

        Route::get('all', 'OfferController@all')-> name('ajax.offers.all');
        Route::post('delete', 'OfferController@delete')-> name('ajax.offers.delete');

        //with post not reload of page

    });

########################### AJAX ############################

