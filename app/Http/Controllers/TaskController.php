<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::orderBy('priority', 'asc')->get();
        return view('task.index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = Project::all();
        return view('task.create', ['projects' => $projects]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name"=>"required",
            "priority" => "required",
            "project" => "required"
        ]);

        $insert = Task::create([
            "name" => $request->name,
            "priority" => $request->priority,
            "project_id" => $request->project
        ]);

        return $insert ? redirect("/create")->withSuccess("Task Added Successfully") : redirect("/create")->withError("Operation Failed");
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $task = Task::firstWhere('id', $task);
        return view('task.show', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $projects = Project::all();
        $task = Task::firstWhere('id', $id);
        return view('task.edit', ['task' => $task, 'projects' => $projects]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            "id" => "required",
            "name"=>"required",
            "priority" => "required"
        ]);

        $task = Task::firstWhere('id', $request->id);
        $task->name = $request->name;
        $task->priority = $request->priority;

        $update = $task->save();

        return $update ? redirect("/$task->id/edit")->withSuccess("Task Updated Successfully") : redirect("/$task->id/edit")->withError("Operation Failed");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $task = Task::firstWhere('id', $id);
        $delete = $task->delete();
        return $delete ? redirect("/")->withSuccess("Task Deleted Successfully") : redirect("/")->withError("Operation Failed");
    }

    public function taskOrderChange(Request $request)
    {
        $data = $request->input('task');

        foreach($data as $index => $id)
        {
            
            $task = Task::find($id);
            $task->priority = $index;
            $task->update();

        }

        return response()->json([
                'message' => 'Task Priority Updated',
                'alert-type' => 'success'
        ]);
    }
}
;