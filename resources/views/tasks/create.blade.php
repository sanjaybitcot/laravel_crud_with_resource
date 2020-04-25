@extends('layouts.layout')
@section('content')
    <h1>Add New Task</h1>
    <hr>
    <form action="{{ url('tasks') }}" method="post">
        {{ csrf_field() }}
        <a style="float: right;" class="btn btn-success" href="{{ route('tasks.index') }}">Display All</a><br><br>
        @if($errors->any())
            <div class="error_msg alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>      
        @endif
        <div class="form-group">
            <label for="title">Task Title</label>
            <input type="text" class="form-control" name="title" id="taskTitle" value="{{ old('title') }}">
            @if($errors->has('title'))
                <p class="error">{{$errors->first('title') }}</p>
            @endif
        </div>

        <div class="form-group">
            <label for="description">Task Description</label>
            <textarea class="form-control" id="taskDescription" name="description"></textarea>
            @if($errors->has('description'))
                <p class="error">{{ $errors->first('description') }}</p>
            @endif
        </div>   
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
<style type="text/css">
    .error{
        color:red;
    }
</style>
<script type="text/javascript">
    setTimeout( function(){
        $(".error_msg").slideUp();
    },'5000');
</script>