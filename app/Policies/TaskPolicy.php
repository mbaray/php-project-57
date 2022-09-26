<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class TaskPolicy
{
    use HandlesAuthorization;

    public function viewAny(?User $user)
    {
        return true;
    }

    public function view(?User $user, Task $task)
    {
        return true;
    }

    public function create(User $user)
    {
        return Auth::check();
    }

    public function update(User $user, Task $task)
    {
        return Auth::check();
    }

    public function delete(User $user, Task $task)
    {
        return $user->id === $task->creator->id;
    }
}
