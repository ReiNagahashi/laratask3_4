@extends('welcome')
@section('page')

<div class="container">
        @if(count($errors) > 0)
            <ul class="list-group">
                @foreach($errors->all() as $errors)
                     <li class="list-group-item text-danger">{{$errors}}</li>
                @endforeach
            </ul>
        @endif
        <form action="{{route('task.create')}}" method="POST">
          @csrf
          <div>
            <div class="form-group">
                <input type="text" name="title" class="form-control">
            </div>
            <input type="submit" value="Submit" class="btn btn-primary">
          </div>
        </form>
        @if(count($tasks) > 0)
        <form id="task-form">
            <label class="radio-inline"><input type="radio" id="all" name="task" checked>全て</label>
            <label class="radio-inline"><input type="radio" id="completed" name="task">完了</label>
            <label class="radio-inline"><input type="radio" id="uncompleted" name="task">作業中</label>
        </form>     
        <table class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>タイトル</th>
                    <th>状況</th>
                    <th>アクション</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                    <tr class="tasks">
                        <td>{{$task->id}}</td>
                        <td>{{$task->title}}</td>
                        <td>
                            <form action="/updateCompleted" method="post">
                                @csrf
                                <input type="hidden" name="task_id" value="{{$task->id}}">
                                    @if($task->isCompleted)
                                       <input class="btn btn-success completedTasks" type="submit" value="完了">
                                    @else
                                       <input class="btn btn-info uncompletedTasks" type="submit" value="作業中">
                                    @endif
                            </form>
                        </td>
                        <td><button class="btn btn-danger">削除</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @endif
</div>
    <script>
        // Radio button
        const all = document.getElementById('all');
        const completed = document.getElementById('completed');
        const uncompleted = document.getElementById('uncompleted');
        // Task elements
        const tasks = document.querySelectorAll('.tasks');
        const completedTasks = document.querySelectorAll('.completedTasks');
        const uncompletedTasks = document.querySelectorAll('.uncompletedTasks');
        //Method 
        document.getElementById('task-form').addEventListener('click',() =>{
            if(all.checked){
                tasks.forEach( task => task.style.display = 'table-row');
            }else if(completed.checked){
                completedTasks.forEach(task=> task.closest('.tasks').style.display = 'table-row');
                uncompletedTasks.forEach(task=> task.closest('.tasks').style.display = 'none');
            }else if(uncompleted.checked){
                completedTasks.forEach(task=> task.closest('.tasks').style.display = 'none');
                uncompletedTasks.forEach(task=> task.closest('.tasks').style.display = 'table-row');
              }
        });
    </script>
@endsection


