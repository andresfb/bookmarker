<?php

namespace App\Policies;

use App\Models\Section;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SectionPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Section $section): bool
    {
        return $user->is($section->user);
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Section $section): bool
    {
        return $user->is($section->user);
    }

    public function delete(User $user, Section $section): bool
    {
        return $user->is($section->user);
    }

    public function restore(User $user, Section $section): bool
    {
        return $user->is($section->user);
    }

    public function forceDelete(User $user, Section $section): bool
    {
        return false;
    }
}
