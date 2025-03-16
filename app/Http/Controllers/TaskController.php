<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        $filters = $request->only(['search', 'priority', 'status']); 

        $tasks = Task::filter($filters)->paginate(10);

        return response()->json($tasks);
    }

    public function show($id)
    {
        $task = Task::find($id);
        return $task ? response()->json($task) : response()->json(['message' => 'Task not found'], 404);
    }

    public function store(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['message' => 'Please log in to create a task.'], 401);
        }
 
        $validator = \Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required',
            'due_date' => 'required|date|after:today',
            'priority' => ['required', Rule::in(['Low', 'Medium', 'High'])],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $task = Task::create($request->all());
        return response()->json($task, 201);
    }

    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }
 
        $validator = \Validator::make($request->all(), [
            'title' => 'string|max:255',
            'due_date' => 'date|after:today',
            'priority' => Rule::in(['Low', 'Medium', 'High']),
            'description' => 'required',
            'status' => Rule::in(['Pending', 'Completed']),
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $task->update($request->all());
        return response()->json($task);
    }

    public function destroy($id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->delete();
        return response()->json(['message' => 'Task deleted successfully']);
    }
}
