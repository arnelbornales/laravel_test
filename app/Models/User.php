<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;
    
    const CLIENTS = 1;
    const EMPLOYEE = 2;
    const SUBCONTRACTORS = 3;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['fullname', 'email', 'type', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    
    /**
     * Get all of the tasks for the user.
     */
    public function tasks()
    {
        return $this->belongsToMany('App\Models\Task','tasks_users','user_id','task_id');
    }
    /**
     * Get all of the tasks for the user.
     * @param $id
     * @return BOOL
     */
    public static function allowedTask($id){
        //$id = 6;
        $user = User::find($id);
        return (null !== $user) ? in_array($user->type,[User::EMPLOYEE, User::SUBCONTRACTORS]) : FALSE;
    }
}
