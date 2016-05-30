<?php

/*
|--------------------------------------------------------------------------
| Application Routes - * DO NOT DELETE *
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();

/**
* When a user visits the home page if its a guest then direct to login if not 
* use the appropiate route to manage its path
*/
Route::get('/', function(){
    return view('auth.login');
});


Route::group(['middleware' => 'auth'], function() {

    Route::get('/', 'UserLevelController@index'); // This route will return 2 paths depending on the Admin status
    
    Route::get('/profile/', 'UserLevelController@profileView');
    
});

/**
|-----------------------------------------------------------------------------------
| Admin Route Middleware - * DO NOT DELETE *
|-----------------------------------------------------------------------------------
|
| Here is where you have to specify and route all the application's Admin functions
| same as the normal user routes.
| Do not modify the middleware route group , and do not enter any route that does
| not follow admin authentication procedure.
| Contact Administrator before making any changes to this route group
|
| Important point to remember is that this middleware group is used only to access 
| Administrator secific routes. What ever routes in auth middleware , admin can
| go through it but not vice versa.
|
| After adding a new middleware a composer update should be made to add the 
| middleware to autoloader.
|-----------------------------------------------------------------------------------
*/

Route::group(['middleware' => ['auth','admin']], function() {
    
    /**
    * User Management Routes
    */
    Route::get('/UserManagement','UserManagementController@UserManagement');
    
    Route::post('/UserManagement/add', 'UserManagementController@AddUser');
    //User Management Routes End
    
    /*Subject Management*/
    
    Route::get('/subject', 'subjectController@show')->Name('Subjectmain');
    
    Route::get('/subject/new', 'subjectController@add');
    
    Route::post('/subject/Add_Subject', 'subjectController@addSubjects');
    
    Route::get('/subject/edit/{subject}', 'subjectController@edit');
    
    Route::patch('/subject/Edit_Subject/{subject}', 'subjectController@editSubjects');
    
    Route::get('/subject/delete/{subject}', 'subjectController@delete');
    
    /*Subject Management ends*/
    
});

