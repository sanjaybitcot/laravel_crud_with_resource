@extends('layouts.layout')
@section('content')
    
    <div class="col-md-12">
		<div>
			<a style="float: right;" class="btn btn-success" href="{{ route('tasks.create') }}">Add New</a>
			<a style="float: right;margin-right: 20px;" class="btn btn-success" href="#" id="applyFilter">Apply Filter</a>
			<h3 style="float: left;">All List</h3>
		</div>
		
		<div class="clearfix"></div>
    	@if(session('success_msg'))
		<div class="alert alert-success alert-dismissible">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			{{ session('success_msg') }}
		</div>
    	@endif

    	@if(session('error_msg'))
		<div class="alert alert-danger alert-dismissible">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			{{ session('error_msg') }}
		</div>
    	@endif
		<div id="filterForm" class="col-md-6" style="float: right;display: none;">
			<h2>Filter</h2>
			<div class="panel panel-default">
				<div class="panel-body">
					<form class="form-inline" action="{{ route('tasks.index') }}" method="post">
						{{ csrf_field() }}
						<div class="form-group">
							<label for="title">Title:</label>
							<input type="text" class="form-control" id="title" name="title">
						</div>
						<button type="submit" class="btn btn-default">Submit</button>
					</form>
				</div>
			</div>
		</div>
	    <table class="table">
	    	<caption><strong>Total Records </strong>{{ $tasks->total() }}</caption>
	    	<tr>
	    		<th>Title</th>
	    		<th>Description</th>
	    		<th>Action</th>
	    	</tr>
	    	@if($tasks)
	    		@foreach($tasks as $task)
	    			<tr>
			    		<td><a href="{{ route('tasks.show',['id'=>$task->id]) }}">{{ $task->title }}</a></td>
			    		<td>{{ $task->description }}</td>
			    		<td>
							<form action="{{ url('tasks', ['id' => $task->id]) }}" method="post">
								<input type="hidden" name="_method" value="DELETE">
								{{ csrf_field() }}
	        					<a class="btn btn-primary" href="{{ url('tasks/'.$task->id.'/edit') }}">Edit</a>
			    				<button class="btn btn-danger">Delete</button>
							</form>
			    		</td>
			    	</tr>
	    		@endforeach
	    	@endif
	    </table>
	    <div>
			{{ $tasks->links() }}
		</div>
    </div>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("#applyFilter").click(function(){
    $("#filterForm").fadeToggle('slow');
  });
});
</script>
