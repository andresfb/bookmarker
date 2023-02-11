<?php

namespace App\Policies;

use App\Models\Marker;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MarkerPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Marker $marker): bool
    {
        return $user->is($marker->user);
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Marker $marker): bool
    {
        return $user->is($marker->user);
    }

    public function delete(User $user, Marker $marker): bool
    {
        return $user->is($marker->user);
    }

    public function restore(User $user, Marker $marker): bool
    {
        return $user->is($marker->user);
    }

    public function forceDelete(User $user, Marker $marker): bool
    {
        return false;
    }
}
