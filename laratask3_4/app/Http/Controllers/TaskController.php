<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TaskController extends Controller
{
    
    public function index(){
        $tasks = Task::all();
        $completedTasks = Task::where('isCompleted','!==', false)->get();
        $uncompletedTasks = Task::where('isCompleted','===', true)->get();

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
        $task->isCompleted = false;
        $task->save();

        return redirect()->back();
    }

    public function completedUpdate(Request $request){
        $task = Task::find($request->task_id);

        if($task->isCompleted){
            $task->isCompleted = false;
        }else{
            $task->isCompleted = true;
        }
        $task->update();

        return redirect()->back();
    }
}
