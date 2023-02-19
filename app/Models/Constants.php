<?php

namespace App\Models;

class Constants
{

    public const ROLE_SUPERADMIN = 'superadmin';
    public const ROLE_ORG_SUPERADMIN = 'org_superadmin';
    public const ROLE_ORG_ADMIN = 'org_admin';
    public const ROLE_ORG_PRINCIPAL = 'org_principal';
    public const ROLE_TEACHER = 'teacher';
    public const ROLE_STUDENT = 'student';
    public const ROLE_GUARDIAN = 'guardian';

    public const PERM_CREATE_TOP_ORG = 'create_top_org';
    public const PERM_CREATE_ORG = 'create_org';
    public const PERM_UPDATE_ORG = 'update_org';
    public const PERM_DELETE_ORG = 'delete_org';
    public const PERM_DEACTIVATE_ORG = 'deactivate_org'; // also reactivate

    public const PERM_CREATE_USER = 'create_user';
    public const PERM_UPDATE_USER = 'update_user';
    public const PERM_DELETE_USER = 'delete_user';

    public const PERM_CREATE_TEACHER_ANY_ORG = 'create_teacher_any_org';
    public const PERM_CREATE_TEACHER = 'create_teacher';
    public const PERM_UPDATE_TEACHER = 'update_teacher';
    public const PERM_DELETE_TEACHER = 'delete_teacher';

    public const PERM_VIEW_STUDENT = 'view_student';
    public const PERM_UPDATE_STUDENT = 'update_student';

}
