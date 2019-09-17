<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
class TaskController extends Controller
{
    public function store(Request $request){
       $task=new Task();

       $this->validate($request,[
           'task'=>'required|max:100|min:5',]);


       $task->task=$request->task;
     $task->save();
     $data=Task::all();
     return view('tasks')->with('tasks',$data);
      
    }
    public function UpdateTaskAsCompleted($id){
        $task=Task::find($id);
        $task->iscompleted=1;
        $task->save();
        return redirect()->back();

    }
    public function UpdateTaskAsnotCompleted($id){
        $task=Task::find($id);
        $task->iscompleted=0;
        $task->save();
        return redirect()->back();

    }
    public function UpdateTaskAsdeleted($id){
        $task=Task::find($id);
        
        $task->delete();
        return redirect()->back();

    }
public function UpdateTaskAsview($id){

    $task=  Task::find($id);
    return view ('updatetask')->with('taskdata',$task);
}
public function updatetask(Request $request){
    $id=$request->id;
    $task=$request->task;
    $data=Task::find($id);
    $data->task=$task;
    $data->save();
    $datas=Task::all();
    return view('tasks')->with('tasks',$datas);
}
}
