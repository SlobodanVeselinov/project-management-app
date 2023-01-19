<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    public function index(){
        $projects = Project::with('users')->with('tickets')->latest()->get();
        return $projects;
    }

    public function addTeamMember(Request $request){
        $project_id = $request->project_id;
        $developer_id = $request->developer_id;
        $project = Project::find($project_id);
        $project->users()->attach($developer_id);
        return $project;
    }

    public function removeTeamMember(Request $request){
        $project_id = $request->project_id;
        $developer_id = $request->developer_id;
        $project = Project::find($project_id);
        $project->users()->detach($developer_id);
        return $project;
    }

    public function create(Request $request){
        $project = new Project();
        $project->name = $request->name;
        $project->description = $request->description;
        $project->start_date = $request->start_date;
        $project->end_date = $request->end_date;
        $project->save();

        return $project;
    }

    
    public function delete($id){
        $project = Project::find($id);
        $project->delete();
        return response('Deleted', 200);
    }
}

