<?php

namespace App\Policies;

use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class TaskStatusPolicy
{
    use HandlesAuthorization;

    public function viewAny(?User $user)
    {
        return true;
    }

    public function view(?User $user, TaskStatus $taskStatus)
    {
        return true;
    }

    public function create(User $user)
    {
        return Auth::check();
    }

    public function update(User $user, TaskStatus $taskStatus)
    {
        return Auth::check();
    }

    public function delete(User $user, TaskStatus $taskStatus)
    {
        return Auth::check();
    }
}
