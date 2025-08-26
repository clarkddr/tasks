<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::orderBy('priority')->get();

        $data = [
            'tasks' => $tasks
        ];
        return Inertia::render('Task/Index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);
        // Get last priority and add 1 to asign to a new task
        $priority = Task::all()->max('priority')+1;

        $task = new Task();
        $task->title = $request->title;
        $task->priority = $priority;
        $task->saveOrFail();
        return redirect()->route('tasks.index')->with('success','Task created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'title'    => ['required','string','max:255'],
        ]);

        $task->update($data);

        // Si quieres feedback
        return back()->with('success', 'Task updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        // Get all tasks with higher priority
        $tasks = Task::where('priority','>', $task->priority)->get();
        $task->delete();
        // Update priorities decrementing
        foreach ($tasks as $task) {
            $task->priority--;
            $task->save();
        }
        return back()->with('success','Task deleted successfully');
    }
}
