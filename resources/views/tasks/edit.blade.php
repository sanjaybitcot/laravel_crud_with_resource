@extends('layouts.layout')
@section('content')
    <h1>Edit Task</h1>
    <hr>
    
    <form action="{{ url('tasks', ['id' => $task->id]) }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT">
        <div class="form-group">
            <label for="title">Task Title</label>
            <input type="text" class="form-control" name="title" id="taskTitle" value="{{ $task->title }}">
        </div>

        <div class="form-group">
            <label for="description">Task Description</label>
            <textarea class="form-control" id="taskDescription" name="description">{{ $task->description }}</textarea>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif    
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection