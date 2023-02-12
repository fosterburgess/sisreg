<?php

namespace Database\Seeders;

use App\Models\Constants;
use App\Models\Role;

class RolePermSeeder
{

    public function __construct()
    {
    }

    public function run()
    {
        $role1 = Role::findOrCreate(Constants::ROLE_SUPERADMIN)->syncPermissions([
            Constants::PERM_CREATE_TOP_ORG,
            Constants::PERM_CREATE_ORG,
            Constants::PERM_UPDATE_ORG,
            Constants::PERM_DELETE_ORG,
            Constants::PERM_CREATE_USER,
            Constants::PERM_UPDATE_USER,
            Constants::PERM_DELETE_USER,
        ]);

        // 'Org super admin can create orgs, create users, and assign users to be org admins below current level and down all the way.'
        $role2 = Role::findOrCreate(Constants::ROLE_ORG_SUPERADMIN)->syncPermissions([
            Constants::PERM_CREATE_ORG,
            Constants::PERM_UPDATE_ORG,
            Constants::PERM_DELETE_ORG,
            Constants::PERM_CREATE_USER,
            Constants::PERM_UPDATE_USER,
            Constants::PERM_DELETE_USER,
        ]);

        // 'Org admin can create orgs, create users, and assign users to be org admins one level below current level'
        $role3 = Role::findOrCreate(Constants::ROLE_ORG_ADMIN)->syncPermissions([
            Constants::PERM_CREATE_ORG,
            Constants::PERM_UPDATE_ORG,
            Constants::PERM_DELETE_ORG,
            Constants::PERM_CREATE_USER,
            Constants::PERM_UPDATE_USER,
            Constants::PERM_DELETE_USER,
        ]);

        $role4 = Role::findOrCreate(Constants::ROLE_TEACHER)->syncPermissions([
            Constants::PERM_UPDATE_STUDENT,
            Constants::PERM_VIEW_STUDENT,
        ]);
    }
}
