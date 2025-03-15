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
        $query = Task::query();

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->has('priority')) {
            $query->where('priority', $request->priority);
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Paginate the results (e.g., 10 tasks per page)
        $tasks = $query->paginate(1);

        return response()->json($tasks);
    }

    public function show($id)
    {
        $task = Task::find($id);
        return $task ? response()->json($task) : response()->json(['message' => 'Task not found'], 404);
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'due_date' => 'required|date|after:today',
            'priority' => ['required', Rule::in(['Low', 'Medium', 'High'])],
        ]);

        $task = Task::create($request->all());
        return response()->json($task, 201);
    }

    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $request->validate([
            'title' => 'string|max:255',
            'due_date' => 'date|after:today',
            'priority' => Rule::in(['Low', 'Medium', 'High']),
            'status' => Rule::in(['Pending', 'Completed']),
        ]);

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
