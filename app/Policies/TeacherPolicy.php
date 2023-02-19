<?php

namespace App\Policies;

use App\Models\Constants;
use App\Models\Reg\Org;
use App\Models\Reg\Teacher;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;

class TeacherPolicy
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
    public function view(User $user, Teacher $teacher): bool
    {
        //
    }

    /**
     * Determine whether the user can create teacher.
     */
    public function create(User $user, Request $request): bool
    {
        if($user->hasPermissionTo(Constants::PERM_CREATE_TEACHER_ANY_ORG)) {
            return true;
        }
        if(!$user->hasPermissionTo(Constants::PERM_CREATE_TEACHER)) {
            return false;
        }
        $teacherSchoolId = (int)$request->get('school_id');
        $usersOrgId = (int)$user->org_id;

        $schoolOrg = Org::find($teacherSchoolId);
        return in_array($usersOrgId, $schoolOrg->getMeta('parent_ids')) || $teacherSchoolId===$usersOrgId;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Teacher $teacher): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Teacher $teacher): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Teacher $teacher): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Teacher $teacher): bool
    {
        //
    }
}
