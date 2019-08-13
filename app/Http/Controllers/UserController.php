<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
    
use App\Models\User;
use Exception;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::paginate(5);
        //$users = [];
        //pages.user will show no users found if empty
        return view('pages.user')->with('users',$users);
    }
    
    /**
     * Display the specified Task resource of the User.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getUserTasks(Request $request, $id)
    {
        $user_tasks = [];
        $user = User::find($id);
        try {
            if (!$user) {
                throw new Exception('no tasks for this user');
            }
            foreach($user->tasks as $task) {
                $user_tasks[] = [
                    'id' => $task->id,
                    'subject' => $task->subject,
                    'body' => $task->body
                ];
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
        
        if ($request->ajax()) {
            return response()->json($user_tasks,200,['message'=>'Success: Fetched Tasks for '.$user->fullname]);
        } else {
            return response()->json($user_tasks);
        }
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
        //
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
        //
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
        //
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
    
}
