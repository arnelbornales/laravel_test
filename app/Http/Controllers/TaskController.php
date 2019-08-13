<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
    
use App\Models\Task;
use App\Models\User;
use App\Models\File;
use Exception;
use Validator;
use DB;
use Alert;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::paginate(5);
        //$tasks = [];
        //pages.task will show no task found if empty
        return view('pages.task')->with('tasks',$tasks);
    }
    
    /**
     * Display the specified User resource of the Task.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getTaskUsers(Request $request,$id)
    {
        $task_users = [];
        $task = Task::find($id);
        try {
            if (!$task) {
                throw new Exception('no users for this task');
            }
            foreach($task->users as $user) {
                $task_users[] = [
                    'id' => $user->id,
                    'fullname' => $user->fullname,
                    'email' => $user->email
                ];
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
        //if ($request->ajax()) {
            return response()->json($task_users,200,['message'=>'Success: Fetched Users for '.$task->subject.' Task']);
        //} else {
        //    return $task_users;
        //}
    }
    
    public function getAvailableUsers($assigned_users) {
        $ids = [];
        foreach($assigned_users as $assigned_user) {
            $ids[] = $assigned_user->id;
        }
        $users = DB::Table('users')->select('id','fullname')->where('type','<>',User::CLIENTS)->whereNotIn('id', $ids)->get();
        return $users;
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
           'subject' => 'required|unique:task|max:200',
           'body' => 'required',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$users = User::where('type',"",[2,3]);
        //dd($users);
        try {
            $task = Task::find($id);
        } catch (Exception $e) {
            return 'invalid id';
        }
        $users = $task->users;
        $user_options = $this->getAvailableUsers($users);
        return view('pages.task_edit')->with(compact('task','users'))->with('user_options',$user_options);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
           'subject' => 'required|max:200',
           'body' => 'required',
           'assign_user' => 'integer'
        ]);
        
        if ($validator->fails()) {
            return redirect()->route('task.edit',['id' => $id])
            ->withErrors($validator)
            ->withInput();
        }
        
        $assign_user = $request->get('assign_user');
        $can_assign_user = User::allowedTask($assign_user);
        if (!$can_assign_user) {
            return redirect()->route('task.edit',['id' => $id])
            ->withErrors($validator)
            ->withInput();
        }
        
        $task = Task::find($id);
        $task->subject =  $request->get('subject');
        $task->body = $request->get('body');
        $task->users()->attach($assign_user);
        $task->save();
        
        Alert::success($task->subject.' was updated.', 'Task');
        return redirect()->route('task.index')->with('success', 'Task updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function uploadFile(Request $request){
        $fids = [];
        //insert the new files to db
        // pass the value back to fids hidden field to the form
        return response()->json(array('files' => $fids), 200);

    }
    
    
}
