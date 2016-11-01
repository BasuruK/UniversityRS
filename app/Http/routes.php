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
* use the appropriate route to manage its path
*/
Route::get('/', function(){
    return view('auth.login');
    
});


Route::group(['middleware' => 'auth'], function() {

    Route::get('/', 'UserLevelController@index'); // This route will return 2 paths depending on the Admin status
    
    Route::get('/profile/', 'UserLevelController@profileView')->Name('profile');

    Route::patch('/profile/{user}', 'UserLevelController@editProfile');

    Route::patch('/profile/password/{user}', 'UserLevelController@editPassword');

    Route::get('/profile/ChangePicture/{user}', 'UserLevelController@UploadPictureForm');

    Route::patch('/upload/image/{user}','UserLevelController@pictureUpload');

    Route::get('image/{id}', 'UserLevelController@showImage');

    /**
     * Request Management Routes
     */
    Route::get('/userRequest/requestForm/','userRequestController@AddRequestForm');
    
    Route::get('/userRequest/requestFormSemester/','userRequestController@AddRequestFormSemester');

    Route::get('/userRequest/Show/','userRequestController@Index');

    Route::get('/userRequest/ShowSemesterRequest/','userRequestController@SemesterRequestIndex');
    
    Route::get('/userRequest/Edit/{userRequest}','userRequestController@EdituserRequestForm');

    Route::get('/userRequest/EditSpecial/{userRequest}','userRequestController@EdituserRequestSpecialForm');

    Route::get('/userRequest/EditSemesterRequest/{userRequest}','userRequestController@EditSemesterRequestForm');

    Route::patch('/userRequest/UpdateSemesterRequest/{userRequest}','userRequestController@UpdateSemesterRequest');

    Route::patch('/userRequest/updateUserRequest/{userRequest}','userRequestController@updateuserRequest');

    Route::post('/userRequest/requestForm/add','userRequestController@AddRequest');

    Route::post('/userRequest/semesterRequestForm/add','userRequestController@AddSemesterRequest');

    Route::get('/userRequest/requestForm/loadBatches','userRequestController@loadBatches');

    Route::get('/userRequest/requestForm/loadSubjects','userRequestController@loadSubjects');

    Route::get('/userRequest/requestForm/loadHalls','userRequestController@loadAvailabeResources');

    Route::get('/userRequest/requestForm/loadHallsDate','userRequestController@loadAvailabeResourcesDate');

    Route::get('/userRequest/requestForm/loadHallsTime','userRequestController@loadAvailabeResourcesTime');

    Route::get('/userRequest/deleteUserRequest/{userRequest}','userRequestController@deleteUserRequest');

    Route::get('/userRequest/deleteSemesterRequest/{userRequest}','userRequestController@deleteSemesterRequest');

    // Request Management Route End

    /**
     * Lecturer Timetable Management
     */

    Route::get('/myTables','userTimetableController@index');

});

/*
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
| Administrator specific routes. What ever routes in auth middleware , admin can
| go through it but not vice versa.
|
| After adding a new middleware a composer update should be made to add the 
| middleware to autoload.
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

    Route::get('AuthorizedUser/{staff_id}/edit', 'UserManagementController@EditAuthorizedUserRedirect');
    
    Route::patch('AuthorizedUser/{staff_id}/edit', 'UserManagementController@EditAuthorizedUserUpdate');
    
    Route::get('AuthorizedUser/{staff_id}/delete', 'UserManagementController@DeleteAuthorizedUser');
    
    //User Management Routes End

    /**
     * Frce Management Routes
     */

    Route::get('/resource/show', 'ResourceController@Index')->Name('Resources');;

    Route::post('/resource/Add', 'ResourceController@AddResource');

    Route::get('/resource/Edit/{resource}', 'ResourceController@EditResourceForm');

    Route::patch('/resource/UpdateResource/{resource}','ResourceController@updateResource');

    Route::get('/resource/DeleteResource/{resource}','ResourceController@deleteResource');

    Route::get('/resource/isResourceInUse/{resource}','ResourceController@isInUseResource');

    

    // Resource Management Routes End
    
    /**
    * Batch Management Routes
    */
    
    Route::get('/batch', 'BatchController@show')->name('batchShow');
    
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
    
    Route::post('/subject/Add_Subject', 'subjectController@addSubjects');
    
    Route::get('/subject/edit/{subject}', 'subjectController@edit');
    
    Route::patch('/subject/Edit_Subject/{subject}', 'subjectController@editSubjects');
    
    Route::get('/subject/delete/{subject}', 'subjectController@delete');
    
    //Subject Management End

    /**
     * Request Management
     */

    //Formal Request Routes

    Route::get('/adminRequest', 'AdminRequestController@show')->name('adminRequestShow');

    Route::get('/adminRequest/newForm', 'AdminRequestController@newForm');

    Route::get('/adminRequest/BatchSort', 'AdminRequestController@SortByBatchYear');

    Route::post('/adminRequest/add', 'AdminRequestController@add');

    Route::get('/adminRequest/delete/{admin_request}','AdminRequestController@delete');

    Route::get('/adminRequest/edit/{admin_request}','AdminRequestController@edit');

    Route::patch('/adminRequest/update/{admin_request}','AdminRequestController@update');

    Route::get('/adminRequest/notify/{admin_request}','AdminRequestController@notify');

    //Semester Request Management

    Route::get('/adminRequest/semesterRequest','AdminRequestController@showSemesterRequests')->name('adminSemesterRequest');

    Route::get('/adminRequest/semesterRequestEdit/{adminSemesterRequest}','AdminRequestController@editSemesterRequest');

    Route::patch('/adminRequest/semesterRequestUpdate/{adminSemesterRequest}','AdminRequestController@updateSemesterRequest');

    Route::get('/adminRequest/semesterRequestDelete/{adminSemesterRequest}','AdminRequestController@deleteSemesterRequest');

    Route::get('/adminRequest/requestForm/loadBatches','AdminRequestController@loadBatches');

    Route::get('/adminRequest/requestForm/loadSubjects','AdminRequestController@loadSubjects');

    Route::get('/adminRequest/requestForm/loadHalls','AdminRequestController@loadAvailableResources');

    Route::get('/adminRequest/requestForm/loadHallsDate','AdminRequestController@loadAvailableResourcesDate');

    Route::get('/adminRequest/requestForm/loadHallsTime','AdminRequestController@loadAvailableResourcesTime');

    //Request Management End

    //Special Request Management

    Route::get('/adminRequest/specialRequest','AdminRequestController@showSpecialRequests')->name('adminSpecialRequest');

    Route::get('/adminRequest/specialRequestEdit/{adminSpecialRequest}','AdminRequestController@editSpecialRequest');

    Route::patch('/adminRequest/specialRequestUpdate/{adminSpecialRequest}','AdminRequestController@updateSpecialRequests');

    Route::get('/adminRequest/specialRequestDelete/{adminSpecialRequest}','AdminRequestController@deleteSpecialRequests');

    Route::get('/adminRequest/specialRequestForm/loadHalls','AdminRequestController@loadAvailableResourcesSpecialRequest');

    Route::get('/adminRequest/specialRequestForm/loadHallsDate','AdminRequestController@loadAvailableResourcesDateSpecialRequest');

    Route::get('/adminRequest/SpecialRequestForm/loadHallsTime','AdminRequestController@loadAvailableResourcesTimeSpecialRequest');

    //Special Request Management End

    /**
     * Timetable Management Routes
     */
    Route::get('/timetable', 'TimeTableController@showGenerateTimetable');

    Route::get('/timetable/batchTimetableForm/loadBatches', 'TimeTableController@loadBatches');
    
    Route::post('/timetable/batchTimetableForm/batch_Timetable', 'TimeTableController@show');
    
    //Timetable Management End

    /**
     * Resource Timetable Management Routes
     */
    Route::get('/resource/GenerateTimetable/{hallNo}/{hallType}','resourceTimeTableController@Index');
    //Timetable Management End

    /**
     * Administrator Options Routes
     */

    Route::get('/AdminOptions','AdministratorOptionsController@index');
    
    Route::get('/AdminOptions/Send','AdministratorOptionsController@sendMail');
    
    Route::post('/AdminOptions/DeadlineSave','AdministratorOptionsController@deadlineSave');

    Route::get('/AdminOptions/{id}/DeadlineDelete','AdministratorOptionsController@deadlineDelete');

    Route::get('/AdminOptions/SemesterDeadlineChecked','AdministratorOptionsController@semesterRequestChecked');

    Route::get('/AdminOptions/SemesterDeadlineUnchecked','AdministratorOptionsController@semesterRequestUnchecked');

    Route::get('/AdminOptions/truncateTimeTable','AdministratorOptionsController@truncateTimetable');

    Route::get('/AdminOptions/customClearTables/{batch}/{year}','AdministratorOptionsController@clearTimetableForBatchAndYear');

    Route::get('/AdminOptions/masterReset/{password}','AdministratorOptionsController@masterReset');

    Route::get('/AdminOptions/checkPassword/{password}','AdministratorOptionsController@checkAuthenticity');



    // Administrator Options Routes End
});

