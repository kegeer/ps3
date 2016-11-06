<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use App\Task;

class ProjectController extends Controller
{
    public function index()
    {
    	$projects = Project::all();
    	return response()->json([
    		'data' => $projects
		]);	
    }

     public function store(Request $request)
    {
        $data = $request->all();
        $project = Project::create($data);

        return response()->json([
            'success' => true
        ]);
    }
    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->update($request->all());
        return response()->json([
            'success' => true
        ]);

    }
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return response()->json([
            'success' => true
        ]);
    }

    public function tasks($id)
    {
        $tasks = Task::where('project_id', $id)->get();
        return response()->json([
            'data' => $tasks
        ]);
    }
}
