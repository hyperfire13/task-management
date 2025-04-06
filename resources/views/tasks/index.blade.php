<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container text-center">
        <h1>Task Management System</h1>
        <h2>Task List</h2> @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
    </div>
    
    <div class="container">
        <div class="row">
            <div class="table">
                <span class="float-right">{{ $tasks->links() }}</span>
                <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Create Task</a>
                <a href="{{ route('tasks.taskshow') }}" class="btn btn-secondary mb-3">Show Completed Tasks</a>
                <a href="{{ route('auth.logout') }}" class="btn btn-primary mb-3">Logout</a>
                <table class="table  table-striped">
                    <thead>
                        <tr>
                            <th class="col-2">Task Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th class="col-2">Date Created</th>
                            <th class="col-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                        <tr>
                            <td>{{ $task->title }}</td>
                            <td class="text-break"><p>{{ $task->description }}</p></td>
                            <td class="text-break"><p>
                                <img style="max-height: 100px;max-width:100px" src="{{ url('storage/uploaded-images/'.$task->img_path) }}" alt="No Image"></p>
                            </td>
                            <td>{{ $task->completed == 0 ? "To do" : "Done" }}</td>
                            <td>{{ $task->created_at }}</td>
                            <td>
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this task?')">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </form>
                                @if (!$task->completed)
                                <form action="{{ route('tasks.complete', $task->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-warning btn-sm">
                                        <i class="fa fa-check"></i> Complete
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                
                
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
