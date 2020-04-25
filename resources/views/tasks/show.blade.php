@extends('layouts.layout')
@section('content')
    <h1>View Task</h1>
    <hr>
        <!-- <a class="btn btn-success" href="{{ route('tasks.index') }}">Return</a> -->
        <a class="btn btn-success" href="{{ url('tasks') }}">Return</a>
        <div>
            <strong>Task Title</strong> {{ ($task->title)?$task->title:"NA" }}
        </div>

        <div>
            <strong>Task Description</strong> {{ ($task->description)?$task->description:"NA" }}
        </div>      
@endsection