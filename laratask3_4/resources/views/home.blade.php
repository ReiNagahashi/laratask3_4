@extends('welcome')
@section('page')

@push('style')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endpush

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
        <div>
            <label class="radio-inline"><input type="radio" id="all" name="task" checked>全て</label>
            <label class="radio-inline"><input type="radio" id="completed" name="task">完了</label>
            <label class="radio-inline"><input type="radio" id="uncompleted" name="task">作業中</label>
        </div>     
        <table class="table">
            <thead> 
                <th>Id</th>
                <th>タイトル</th>
                <th>状態</th>
                <th>Action</th>
            </thead> 
            <tbody class="switch switchAll">
                @foreach($tasks as $task)
                    <tr>
                        <td>{{$task->id}}</td>
                        <td>{{$task->title}}</td>
                        <td>
                            <form action="/updateCompleted" method="post">
                                @csrf
                                <input type="hidden" name="task_id" value="{{$task->id}}">
                                    @if($task->completed != 0)
                                    <input class="btn btn-success" type="submit" value="完了">
                                    @else
                                    <input class="btn btn-info" type="submit" value="作業中">
                                    @endif
                            </form>
                        </td>
                        <td><button class="btn btn-danger">削除</button></td>
                    </tr>
                @endforeach
            </tbody>
            <tbody class="switch switchCompleted">
                 @foreach($completedTasks as $task)
                    <tr>
                        <td>{{$task->id}}</td>
                        <td>{{$task->title}}</td>
                        <td>
                            <form action="/updateCompleted" method="post">
                                @csrf
                                <input type="hidden" name="task_id" value="{{$task->id}}">
                                    @if($task->completed != 0)
                                    <input class="btn btn-success" type="submit" value="完了">
                                    @else
                                    <input class="btn btn-info" type="submit" value="作業中">
                                    @endif
                            </form>
                        </td>
                        <td><button class="btn btn-danger">削除</button></td>
                  </tr>
                @endforeach
            </tbody>
            <tbody class="switch switchUncompleted">
                 @foreach($uncompletedTasks as $task)
                    <tr>
                        <td>{{$task->id}}</td>
                        <td>{{$task->title}}</td>
                        <td>
                            <form action="/updateCompleted" method="post">
                                @csrf
                                <input type="hidden" name="task_id" value="{{$task->id}}">
                                    @if($task->completed != 0)
                                    <input class="btn btn-success" type="submit" value="完了">
                                    @else
                                    <input class="btn btn-info" type="submit" value="作業中">
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
        $('[name="task"]:radio').change(function(){
            if($('#all').is(':checked')){
                $('.switch').fadeOut();
                $('.switchAll').fadeIn();
            }else if($('#completed').is(':checked')){
                $('.switch').fadeOut();
                $('.switchCompleted').fadeIn();
            }else if($('#uncompleted').is(':checked')){
                $('.switch').fadeOut();
                $('.switchUncompleted').fadeIn();
            }
         })
    </script>
@endsection


