<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Log;

class TaskPolicy
{
    public function manageTasks(User $user)
    {
        return $user->role->name === 'manager';
    }


    public function viewTask(User $user, $taskId)
    {
        $task = Task::findOrFail($taskId);
        return $user->role->name === 'manager' || $user->id === $task->assigned_user_id;
    }


}
