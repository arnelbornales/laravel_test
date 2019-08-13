<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['subject','body'];
    
    /**
     * Get all of the users for the task.
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User','tasks_users','task_id','user_id');
    }
}
