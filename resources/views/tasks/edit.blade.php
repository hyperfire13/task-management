<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <br>
    <br>
<div class="container">
    <h1>Edit Task</h1>
    <form  action="{{ route('tasks.update', $task->id) }}" method="POST" enctype="multipart/form-data"> 
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input value="{{ $task->title }}" type="text" class="form-control" id="title" name="title" >
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ $task->description }}</textarea>
        </div>
        @if($task->img_path)
            <div class="form-group">
                <label for="description">Existing Image: </label>
                <img  style="max-height: 100px;max-width:100px" src="{{ url('storage/uploaded-images/'.$task->img_path) }}" alt="No Image"></p>
            </div>
        @endif
        <div class="form-group">
            <label for="description">Image (optional)</label>
            <input type="file" class="form-control" id="fileImg" name="fileImg" >
        </div>
        {{-- <div class="form-group">
            <label for="priority">Priority</label>
            <select class="form-control" id="priority" name="priority" >
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>
        </div>
        <div class="form-group">
            <label for="due_date">Due Date</label>
            <input type="date" class="form-control" id="due_date" name="due_date">
        </div> --}}
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    @if ($errors->any())
    <br>
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>