<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function directorFunction(User $user)
    {
        if (!empty($user->worker)) {
            return $user->worker->role === 'Директор';
        }
    }

    public function workerFunction(User $user)
    {
        return $user->worker;
    }
}
