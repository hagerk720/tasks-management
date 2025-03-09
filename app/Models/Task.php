<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'status_id', 'due_date', 'assigned_user_id', 'created_by', 'parent_task_id'];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_user_id');
    }

    public function dependencies()
    {
        return $this->hasMany(Task::class, 'parent_task_id');
    }

    public function parentTask()
    {
        return $this->belongsTo(Task::class, 'parent_task_id');
    }

    public function isCompletable()
    {
        return $this->dependencies()->where('status_id', '!=', 3)->count() === 0;
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
