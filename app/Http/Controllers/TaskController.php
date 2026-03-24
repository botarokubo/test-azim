<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        return auth()->user()->tasks;
    }

    public function store(Request $request)
    {
        return Task::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
        ]);
    }

    public function update(Request $request, Task $task)
    {
        $task->update($request->all());
        return $task;
    }

    public function delete(Task $task)
    {
        $task->delete();
        return response()->noContent();
    }


}
