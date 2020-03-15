<?php

namespace App\Http\Controllers;

use App\Task;
use App\Http\Resources\TaskResource;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


class TaskController extends Controller
{
    public function index()
    {
        $tasks =  TaskResource::collection(auth()->user()->tasks()->with('creator')->latest()->paginate(5));

        return view('tasks.view', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|max:255',
            'description' =>'required|max:255',
            'due' => 'required'

        ]);
        $input = $request->all();

        if ($request->has('due')){
            $input['due'] = Carbon::parse($request->due)->toDateTimeString();
        }
        auth()->user()->tasks()->create($input);

        return redirect()->action('TaskController@index');
    }

    public function show(Task $task)
    {
        $task = new TaskResource($task->load('creator'));

        return view('tasks.show',compact('task'));
    }

    public function edit(Task $task)
    {
        $task = new TaskResource($task->load('creator'));
        return view('tasks.edit',compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title'=>'required|max:255',
            'description' =>'required|max:255',
            'due' => 'required'
        ]);
        $input = $request->all();

        if ($request->has('due')){
            $input['due'] = Carbon::parse($request->due)->toDateTimeString();
        }

        $task->update($input);

        return redirect()->action('TaskController@index');

    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->action('TaskController@index');
    }
}
