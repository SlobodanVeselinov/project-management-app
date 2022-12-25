<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    
    public function getUser (Request $request) {
        $id = Auth::user()->id;
        $user = User::with('role')->with('projects')->with('tickets')->where('id', $id)->first();
        return $user;
    }

    public function getAllUsers(){
        return User::with('role')->orderBy('role_id', 'asc')->get();
    }

    public function getAllDevelopers(){
        $developers = User::with('role')->where('role_id', '3')->get();
        return $developers;
    }

    public function getAssignedDevelopers($project_id){
        $project = Project::where('id', $project_id)->first();
        $assignedDevelopers = $project->users; 
        return $assignedDevelopers;
    }
     

    public function freeDevelopers($project_id){
        $freeDevelopers = User::whereDoesntHave('projects', function($q) use ($project_id) {
            $q->where('project_id', '=', $project_id);
        })->get();
        return $freeDevelopers;
    }

    public function updateUser(Request $request){
        $user = User::find($request->id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role;
        $user->save();
        return $user;
    }

    public function removeUser(Request $request){
        $user = User::find($request->id);
        $user->delete();
        return response()->json("User Deleted");
    }
    
}
