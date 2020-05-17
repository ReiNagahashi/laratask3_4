<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TaskController extends Controller
{
    
    public function index(){
        $tasks = Task::all();
        $completedTasks = Task::where('completed','!=', 0)->get();
        $uncompletedTasks = Task::where('completed','==', 0)->get();

        return view('home')->with('tasks',$tasks)
                           ->with('completedTasks',$completedTasks)
                           ->with('uncompletedTasks',$uncompletedTasks); 
    }
    public function create(Request $request){
        $this->validate($request,[
            'title'=>'required',
            ]);

        $task = new Task;
        $task->title = $request->title;
        $task->completed = 0;
        $task->save();

        return redirect()->back();
    }

    public function completedUpdate(Request $request){
        $task = Task::find($request->task_id);

        if($task->completed != 0){
            $task->completed = 0;
        }else{
            $task->completed = 1;
        }
        $task->update();

        return redirect()->back();
    }
}
