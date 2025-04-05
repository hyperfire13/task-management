<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Http\RedirectResponse;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::where('users_id', 2)->orderBy('created_at', 'desc')->simplePaginate(15);
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request): RedirectResponse
    {
        // Create the uploads directory if it doesn't exist
        $imageName = null;
        $uploadPath = public_path('uploaded-images');
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }
        // Store the image
        if ($request->file('fileImg')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move($uploadPath, $imageName);
        }
        Task::create([
            'users_id' => 2,
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'img_path' => $imageName,
            'due_date' => null,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task Created!');
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
    public function update(UpdateTaskRequest $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
