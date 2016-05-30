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

    /**
     * Request Management Routes
     */
    Route::get('/userRequest/requestForm/','userRequestController@AddRequestForm');

    Route::get('/userRequest/Show/','userRequestController@Index');

    Route::get('/userRequest/Edit/{userRequest}','userRequestController@EdituserRequestForm');

    Route::patch('/userRequest/updateUserRequest/{userRequest}','userRequestController@updateuserRequest');

    Route::post('/userRequest/requestForm/add','userRequestController@AddRequest');

    Route::get('/userRequest/deleteUserRequest/{userRequest}','userRequestController@deleteUserRequest');

    //Request Management Routes End

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

    Route::get('user/{staff_id}/delete', 'UserManagementController@DeleteUser');

    Route::get('user/{staff_id}/edit', 'UserManagementController@EditPageRedirect');

    Route::patch('user/{staff_id}/edit', 'UserManagementController@EditUserUpdate');
    //User Management Routes End

    /**
     * Resource Management Routes
     */
   

    Route::get('/resource/show', 'ResourceController@Index');

    Route::post('/resource/Add', 'ResourceController@AddResource');

    Route::get('/resource/Edit/{resource}', 'ResourceController@EditResourceForm');

    Route::patch('/resource/UpdateResource/{resource}','ResourceController@updateResource');

    Route::get('/resource/DeleteResource/{resource}','ResourceController@deleteResource');

    // Resource Management Routes End
    
    /**
    * Batch Management Routes
    */
    
    Route::get('/batch', 'BatchController@show')->name('batchShow');;
    
    Route::get('/batch/new', 'BatchController@add');
    
    Route::post('/batch/batch_add', 'BatchController@addBatch');
    
    Route::get('/batch/{batch}','BatchController@edit');
    
    Route::patch('/batch/update/{batch}', 'BatchController@update');
    
    Route::get('/batch/delete/{batch}', 'BatchController@delete');

    //Batch Management Routes End

    /**
     * Subject Management
     */
    
    Route::get('/subject', 'subjectController@show')->Name('Subjectmain');
    
    Route::get('/subject/new', 'subjectController@add');
    
    Route::post('/subject/Add_Subject', 'subjectController@addSubjects');
    
    Route::get('/subject/edit/{subject}', 'subjectController@edit');
    
    Route::patch('/subject/Edit_Subject/{subject}', 'subjectController@editSubjects');
    
    Route::get('/subject/delete/{subject}', 'subjectController@delete');
    
    //Subject Management End

});

