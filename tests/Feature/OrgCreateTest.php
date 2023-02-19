<?php

namespace Tests\Feature;

use App\Actions\Fortify\CreateNewUser;
use App\Models\Constants;
use App\Models\Reg\Org;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\TestSeeder;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrgCreateTest extends TestCase
{

    use DatabaseTransactions;

    public function setUp(): void
    {
        parent::setUp();
        (new TestSeeder())->run();
    }

    /**
     * Test creating an org via a superadmin
     */
    public function test_create_org_as_superadmin(): void
    {
        $superadmin = $this->getUserWithRole(Constants::ROLE_SUPERADMIN);
        $name = 'org2';
        $output = $this->actingAs($superadmin)->post('/org', [
            'name'=> $name,
            'level_type' => Org::ORG_LEVEL_TYPE_STATE,
        ]);

        $output->assertRedirect();
        $org = Org::where('name', $name)->first();

        // top level should have no parent_ids in metadata
        $this->assertEmpty($org->getMeta('parent_ids'));
    }

    public function test_create_org_as_org_admin_top_level_blocked(): void
    {
        $orgadmin = $this->getUserWithRole(Constants::ROLE_ORG_ADMIN);
        $output = $this->actingAs($orgadmin)->post('/org', [
            'name'=>'org 1',
            'level_type' => Org::ORG_LEVEL_TYPE_STATE,
        ]);

        $output->assertStatus(403);
    }

    /**
     * @return void
     */
    public function test_create_org_as_org_admin_sub_org_OK(): void
    {
        $toporg = Org::factory()->createOne();
        $orgadmin = $this->getUserWithRole(Constants::ROLE_ORG_ADMIN);
        $orgadmin->org_id = $toporg->id;
        $time = microtime(true);
        $name = "org ".$time;
        $output = $this->actingAs($orgadmin)->post('/org', [
            'name'=>$name,
            'parent_id'=> $toporg->id,
            'level_type' => Org::ORG_LEVEL_TYPE_DISTRICT,
        ]);

        $output->assertRedirect();

        $org = Org::where('name', $name)->first();
        $this->assertEquals($name, $org->name);
        $this->assertContains($toporg->id, $org->getMeta('parent_ids'));
        $this->assertCount(1, $org->getMeta('parent_ids'));
    }

    /**
     * Teacher should NOT be able to make an org
     */
    public function test_create_org_as_teacher(): void
    {
        $teacher = $this->getUserWithRole(Constants::ROLE_TEACHER);
        $output = $this->actingAs($teacher)->post('/org', [
            'name'=>'org 1',
            'level_type' => Org::ORG_LEVEL_TYPE_STATE,
        ]);
        $output->assertStatus(403);
    }


    private function getUserWithRole(string $roleName): User
    {
        $cnu = new CreateNewUser();
        /** @var User $u */
        $u = $cnu->create(
            [
                'email' => 'superadmin@example.com', 'name' => 'superadmin1',
                'password' => '123123123',
                'password_confirmation' => '123123123',
                'terms' => true,
            ]
        );
        $u->assignRole(Role::findByName($roleName));

        return $u;
    }

}
