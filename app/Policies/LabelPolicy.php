<?php

namespace App\Policies;

use App\Models\Label;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class LabelPolicy
{
    use HandlesAuthorization;

    public function viewAny(?User $user)
    {
        return true;
    }

    public function view(?User $user, Label $label)
    {
        return true;
    }

    public function create(User $user)
    {
        return Auth::check();
    }

    public function update(User $user, Label $label)
    {
        return Auth::check();
    }

    public function delete(User $user, Label $label)
    {
        return Auth::check();
    }
}
