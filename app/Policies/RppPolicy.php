<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Rpp;
use Illuminate\Auth\Access\HandlesAuthorization;

class RppPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Rpp');
    }

    public function view(AuthUser $authUser, Rpp $rpp): bool
    {
        return $authUser->can('View:Rpp');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Rpp');
    }

    public function update(AuthUser $authUser, Rpp $rpp): bool
    {
        return $authUser->can('Update:Rpp');
    }

    public function delete(AuthUser $authUser, Rpp $rpp): bool
    {
        return $authUser->can('Delete:Rpp');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Rpp');
    }

    public function restore(AuthUser $authUser, Rpp $rpp): bool
    {
        return $authUser->can('Restore:Rpp');
    }

    public function forceDelete(AuthUser $authUser, Rpp $rpp): bool
    {
        return $authUser->can('ForceDelete:Rpp');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Rpp');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Rpp');
    }

    public function replicate(AuthUser $authUser, Rpp $rpp): bool
    {
        return $authUser->can('Replicate:Rpp');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Rpp');
    }

}