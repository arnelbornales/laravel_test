@extends('layouts.app')

@section('title', 'Edit Task')

@section('content')
<div class="row justify-content-md-center">
    <div class="col-lg-6 col-md-auto">
        <div class="card col-xs-12">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h2 class="card-header-title">Tasks</h2>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form class="form-edit" method="post" action="{{ route('task.update', $task->id) }}" accept-charset="UTF-8" class="uploadform" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @if(isset($error))
                            <div class="alert alert-danger">
                                {{ $error }}}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-sm-12">
                                @if(session()->get('success'))
                                    <div class="alert alert-success">
                                        {{ session()->get('success') }}
                                        {{ session()->get('data') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('subject') ? 'has-error' : '' }}">
                            <label for="subject">Subject</label>
                            <input type="text" class="form-control" id="subject" name="subject" value="{{ old('subject', isset($task) ? $task->subject : '') }}">
                            @if($errors->has('subject'))
                                <span class="help-block">{{ $errors->first('subject') }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
                            <label for="remarks">Body</label>
                            <textarea class="form-control" name="body" id="body" cols="30" rows="5">{{ old('body', isset($task) ? $task->body : '') }}</textarea>
                            @if($errors->has('body'))
                                <span class="help-block">{{ $errors->first('body') }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('assign_user') ? 'has-error' : '' }}">
                            <label for="assign_user">Assign User</label>
                            <select name="assign_user" class="form-control">
                             @foreach ($user_options as $option)
                                <option value="{{ $option->id }}">{{ $option->fullname }}</option>
                             @endforeach
                             </select>
                            @if($errors->has('assign_user'))
                            <span class="help-block">{{ $errors->first('assign_user') }}</span>
                            @endif
                        </div>
                        
			<div class="form-group {{ $errors->has('file') ? 'has-error' : '' }}">
                            <label for="file">File Attachment</label>
                            <input type="file" class="form-control" id="file" name="files[]" data-url="{{ route('task.upload', $task->id) }}" value="{{ old('subject', isset($task) ? $task->file : '') }}">
                            @if($errors->has('file'))
                            <span class="help-block">{{ $errors->first('file') }}</span>
                            @endif
                            <div id="progress">
                            <div class="bar" style="width: 0%; height: 18px; background: green;"></div>
                            </div>

                        <input type="hidden" name="file_ids" id="file_ids" value="">
                        <input name="_method" type="hidden" value="PUT">
                        <div id="files_list"></div>
                        <p id="loading"></p>
                        <button type="submit" class="btn btn-primary btn-primary-outline" value="Submit">Submit</button>@if(isset($back)) | <a href="{{ $back }}">cancel</a> @endif
                    </form>
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="card-header-title">Assigned Users</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if(isset($users) && !empty($users))
                <table id="table-users" class="table table-striped table-responsive">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Fullname</th>
                        <th scope="col">Type</th>
                        <th scope="col">Email</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr id="user-{{ $user->id }}" class="user">
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->fullname }}</td>
                            <td>
                            @if($user->type == 1)
                                Client
                            @elseif($user->type == 2)
                                Employees
                            @elseif($user->type == 3)
                                Subcontractors
                            @endif
                            </td>
                            <td>{{ $user->email }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @else
                    <h3>No user found.</h3>
                @endif
            </div>

            


        </div>
    </div>
</div>
@endsection
