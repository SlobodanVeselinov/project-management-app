<?php

use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RolesController;
use App\Http\Controllers\Api\TicketController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\RegisterController;



// MIDDLEWARE ROUTES
Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user', [UserController::class, 'getUser']);
    Route::get('/authenticated', function (Request $request) { return true; });
    // Route::get('/projects', [ProjectController::class, 'index']);
    Route::get('/getAllDevelopers', [UserController::class, 'getAllDevelopers']);
    Route::get('/getAllUsers', [UserController::class, 'getAllUsers']);
    Route::get('/getAssignedDevelopers/{project_id}', [UserController::class, 'getAssignedDevelopers']);
    Route::get('/freeDevelopers/{project_id}', [UserController::class, 'freeDevelopers']);
    Route::get('/projects', [ProjectController::class, 'index']);
    Route::post('/createProject', [ProjectController::class, 'create']);
    Route::get('/projects/{id}', [ProjectController::class, 'getProject']);
    
    //Routes for tickets
    Route::get('/projects/{project_id}/tickets/{user_id}', [TicketController::class, 'getTickets']);
    Route::get('/projects/tickets/{ticket_id}', [TicketController::class, 'getTicket']);
    Route::get('/user/{user_id}/tickets', [TicketController::class, 'getUserTickets']);
    Route::post('/createTicket', [TicketController::class, 'createTicket']);
    Route::post('/assign-developer-to-ticket', [TicketController::class, 'assignDeveloper']);
    Route::post('/remove-developer-to-ticket', [TicketController::class, 'removeDeveloper']);
    ////////////////



    Route::post('/addTeamMember', [ProjectController::class, 'addTeamMember']);
    Route::post('/removeTeamMember', [ProjectController::class, 'removeTeamMember']);
    Route::post('/deleteUser', [UserController::class, 'removeUser']);
    Route::post('/updateUser', [UserController::class, 'updateUser']);
    Route::post('/createUser', [RegisterController::class, 'createUser']);

});


//PUBLIC ROUTES
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/getRoles', [RolesController::class, 'getRoles']);
Route::get('/user/{user_id}/tickets', [TicketController::class, 'getUserTickets']);
//TESTING ROUTES
// Route::get('/userrole', [UserController::class, 'userRole']);
// Route::get('/projectuser', [UserController::class, 'projectuser']);
// Route::get('/freeDevelopers/{project_id}', [UserController::class, 'freeDevelopers']);

  

// Route::get('/test', function(){
//     $projects = Project::with('users')->whereHas('users', function($query){
//         $query->where('user_id', '=', '2');
//     })->get();
//     return $projects;
// });