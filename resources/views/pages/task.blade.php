@extends('layouts.app')

@section('title', 'Task')

@section('content')
    <div class="row justify-content-md-center">
        <div class="col-md-auto">
            <div class="card col-xs-12">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-header-title">Tasks</h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if(isset($tasks) && !empty($tasks))
                    <table id="table-tasks" class="table table-bordered table-responsive">
                        <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Body</th>
                            <th scope="col">Manage</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tasks as $task)
                        <tr id="task-{{ $task->id }}">
                            <th scope="row">{{ $task->id }}</th>
                            <td id="task-{{ $task->id }}" class="task-col">{{ $task->subject }}</td>
                            <td>{{ $task->body }}</td>
                            <td>
                                <a href="{{ route('task.edit', ['id' => $task->id]) }}" class="btn btn-info" role="button">Edit</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {!! $tasks->render() !!}
                    @else
                        <h3>No tasks found.</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
