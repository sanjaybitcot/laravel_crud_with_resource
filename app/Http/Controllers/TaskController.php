<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //allpy for searching
        if($request->title)
        {
            $tasks = Task::select('title','description')
            ->where('title','LIKE','%'.$request->title.'%')
            ->orderBy('id','desc')
            ->paginate(5);
        }
        else
        {
            $tasks = Task::orderBy('id','desc')->paginate(5);
        }
        return view('tasks.index',compact('tasks'));
         
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //for validation
        $message = array(
            'title.required'=>"Please enter title.",
            'title.min'=>"Please enter title must be at least 5 characters.",
            'description.required'=>"Please enter description.",
        );
        $this->validate($request, [
            'title'=>'required|min:5|max:100',
            'description'=>'required',
        ],$message);
        //end for validation

        $post = new Task;
        $post->title = $request->title;
        $post->description = $request->description;
        $save = $post->save();
        if($save)
        {
           return redirect('tasks')->with('success_message','Task saved successfully'); 
        }
        else
        {
            return redirect('tasks')->with('success_message','Task saved successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //$task   = Task::find($task->id);
        return view('tasks.show',compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view('tasks.edit',compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $task   = Task::find($task->id);
        $task->title = $request->title;
        $task->description = $request->description;
        $task = $task->save();
        if($task)
        {
           return redirect('tasks')->with('success_msg','Task Updated successfully'); 
        }
        else
        {
            return redirect('tasks')->with('error_msg','Try Again');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task   = Task::find($task->id);
        $delete = $task->delete();
        if( $delete)
        {
           return redirect()->back()->with('success_msg','Task Deleted successfully'); 
        }
        else
        {
            return redirect('tasks')->with('error_msg','Try agaian!'); 
        }

    }

    public function search(Request $request)
    {
        
    }

   
}
