<?php

namespace Tests\Feature;

use App\Actions\Fortify\CreateNewUser;
use App\Models\Constants;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\TestSeeder;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminUserTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp(): void
    {
        parent::setUp();
        (new TestSeeder())->run();
    }

    /**
     * Test creating a user
     * Create user, assign role
     */
    public function test_create_user_1(): void
    {
        $cnu = new CreateNewUser();
        /** @var User $u */
        $u = $cnu->create(
            ['email'=>'superadmin@example.com','name'=>'superadmin1',
            'password'=>'123123123',
            'password_confirmation'=>'123123123',
            'terms'=>true,
            ]
        );
        $this->assertNotNull($u);
        $this->assertFalse($u->hasRole(Constants::ROLE_SUPERADMIN));
        $u->assignRole(Role::findByName(Constants::ROLE_SUPERADMIN));
        /** @var User $newUser */
        $newUser = User::find($u->id);
        $this->assertTrue($newUser->hasRole(Constants::ROLE_SUPERADMIN));

        $this->assertTrue($newUser->hasPermissionTo(Constants::PERM_CREATE_TOP_ORG));
    }

    /**
     * verify new user created has no roles or permissions
     */
    public function test_create_user_no_role_check_perm(): void
    {
        $cnu = new CreateNewUser();
        /** @var User $u */
        $u = $cnu->create(
            ['email'=>'sample@example.com','name'=>'sample',
                'password'=>'123123123',
                'password_confirmation'=>'123123123',
                'terms'=>true,
            ]
        );
        $this->assertNotNull($u);
        $this->assertFalse($u->hasRole(Constants::ROLE_SUPERADMIN));
        $this->assertFalse($u->hasPermissionTo(Constants::PERM_CREATE_TOP_ORG));
        $this->assertFalse($u->hasPermissionTo(Constants::PERM_CREATE_ORG));
        $this->assertCount(0, $u->getAllPermissions());
        $this->assertCount(0, $u->getRoleNames());
    }
}
