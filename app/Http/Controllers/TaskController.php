<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::where('users_id', Session::get('loginId'))->orderBy('created_at', 'desc')->simplePaginate(5);
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
        $imageName = null;
        $uploadPath = 'public/uploaded-images';
        // Store the image
        if ($request->file('fileImg')) {
            $fileUpload = $request->file('fileImg');
            $imageName = time() . '.' . $fileUpload->extension();
            $fileUpload->storeAs($uploadPath, $imageName);
            // $request->image->move($uploadPath, $imageName);
        }
        Task::create([
            'users_id' => Session::get('loginId'),
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
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        
        $uploadPath = 'public/uploaded-images';
        $updateArray = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'due_date' => null,
        ];
        // Store the image
        if ($request->file('fileImg')) {
            $imageName = null;
            $fileUpload = $request->file('fileImg');
            $imageName = time() . '.' . $fileUpload->extension();
            $fileUpload->storeAs($uploadPath, $imageName);
            $updateArray['img_path'] = $imageName;
            // dd($updateArray);
            // $request->image->move($uploadPath, $imageName);
        }
        $task->update($updateArray);

        return redirect()->route('tasks.index')->with('success', 'Task Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task Deleted!');
    }

    public function complete(Task $task)
    {
        $task->update([
            'completed' => 1,
            'completed_at' => now(),
        ]);
        return redirect()->route('tasks.index')->with('success', 'Marked Task as Completed!');
    }
    public function showCompleted(Task $task)
    {
        $completedTasks = Task::where('completed' , true)
            ->where('users_id', '=' , Session::get('loginId'))
            ->orderBy('updated_at', 'desc')
            ->get();
        return view('tasks.taskshow', compact('completedTasks'));
    }
}
