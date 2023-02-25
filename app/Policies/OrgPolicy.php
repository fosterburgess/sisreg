<?php

namespace App\Policies;

use App\Models\Constants;
use App\Models\Reg\Org;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;

class OrgPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Org $org): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Request $request): bool
    {
        if ($request->get('parent_id') === null) {
            return $user->hasPermissionTo(Constants::PERM_CREATE_TOP_ORG);
        }
        return $user->hasPermissionTo(Constants::PERM_CREATE_ORG);
    }

    public function createTopLevel(User $user, Request $request): bool
    {
        return $user->hasPermissionTo(Constants::PERM_CREATE_TOP_ORG);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Org $org): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Org $org): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Org $org): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Org $org): bool
    {
        //
    }
}
