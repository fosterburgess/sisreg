<?php

namespace Tests\Feature;

use App\Actions\Fortify\CreateNewUser;
use App\Models\Constants;
use App\Models\Reg\Org;
use App\Models\Reg\Teacher;
use App\Models\Role;
use App\Models\User;
use App\Services\OrgService;
use Database\Seeders\TestSeeder;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TeacherCRUDTest extends TestCase
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
    public function test_create_teacher_as_superadmin(): void
    {
        $service = new OrgService();
        $superadmin = $this->getUserWithRole(Constants::ROLE_SUPERADMIN);
        $topOrg = $this->setupOrgStructure($superadmin);
        $disOrg = $service->createOrg([
            'parent_id' => $topOrg->id, 'name' => 'dis1', 'level_type' => Org::ORG_LEVEL_TYPE_DISTRICT
        ]);
        $schoolOrg = $service->createOrg([
            'parent_id' => $disOrg->id, 'name' => 'school 1', 'level_type' => Org::ORG_LEVEL_TYPE_SCHOOL
        ]);

        $this->assertCount(2, $schoolOrg->getMeta('parent_ids'));

        $name = 'teacher'.microtime(true);
        $output = $this->actingAs($superadmin)->post(route('teacher.store'), [
            'first_name' => $name,
            'email' => microtime(true)."@example.com",
            'org_id' => $schoolOrg->id
        ]);
        $output->assertRedirect();

        $t = Teacher::query()->where('first_name', $name)->first();
        $this->assertNotNull($t);
    }

    /**
     * Attempt school2 admin to add teacher to school 1
     * @return void
     */
    public function test_create_teacher_as_orgadmin_failed(): void
    {
        $service = new OrgService();
        $superadmin = $this->getUserWithRole(Constants::ROLE_SUPERADMIN);
        $topOrg = $this->setupOrgStructure($superadmin);
        $disOrg = $service->createOrg([
            'parent_id' => $topOrg->id, 'name' => 'dis1', 'level_type' => Org::ORG_LEVEL_TYPE_DISTRICT
        ]);
        $schoolOrg = $service->createOrg([
            'parent_id' => $disOrg->id, 'name' => 'school 1', 'level_type' => Org::ORG_LEVEL_TYPE_SCHOOL
        ]);
        $dis2Org = $service->createOrg([
            'parent_id' => $topOrg->id, 'name' => 'dis2', 'level_type' => Org::ORG_LEVEL_TYPE_DISTRICT
        ]);
        $school2Org = $service->createOrg([
            'parent_id' => $dis2Org->id, 'name' => 'school 2', 'level_type' => Org::ORG_LEVEL_TYPE_SCHOOL
        ]);

        // create principal/etc at school 2
        // try to add teacher at school 1
        $orgAdmin = $this->getUserWithRole(Constants::ROLE_ORG_ADMIN);
        $orgAdmin->org_id = $school2Org->id;
        $orgAdmin->save();

        $name = 'teacher'.microtime(true);
        $output = $this->actingAs($orgAdmin)->post(route('teacher.store'), [
            'first_name' => $name,
            'email' => microtime(true)."@example.com",
            'org_id' => $schoolOrg->id
        ]);
        $output->assertRedirect();

        $t = Teacher::query()->where('first_name', $name)->first();
        $this->assertNull($t);
    }

    public function test_create_teacher_as_orgadmin(): void
    {
        $service = new OrgService();
        $superadmin = $this->getUserWithRole(Constants::ROLE_SUPERADMIN);
        $topOrg = $this->setupOrgStructure($superadmin);
        $disOrg = $service->createOrg([
            'parent_id' => $topOrg->id, 'name' => 'dis1', 'level_type' => Org::ORG_LEVEL_TYPE_DISTRICT
        ]);
        $schoolOrg = $service->createOrg([
            'parent_id' => $disOrg->id, 'name' => 'school 1', 'level_type' => Org::ORG_LEVEL_TYPE_SCHOOL
        ]);
        $dis2Org = $service->createOrg([
            'parent_id' => $topOrg->id, 'name' => 'dis2', 'level_type' => Org::ORG_LEVEL_TYPE_DISTRICT
        ]);
        $school2Org = $service->createOrg([
            'parent_id' => $dis2Org->id, 'name' => 'school 2', 'level_type' => Org::ORG_LEVEL_TYPE_SCHOOL
        ]);

        // create principal/etc at school 2 try to add teacher at school 2
        $orgAdmin = $this->getUserWithRole(Constants::ROLE_ORG_ADMIN);
        $orgAdmin->org_id = $school2Org->id;
        $orgAdmin->save();

        $name = 'teacher'.microtime(true);
        $output = $this->actingAs($orgAdmin)->post(route('teacher.store'), [
            'first_name' => $name,
            'email' => microtime(true)."@example.com",
            'org_id' => $school2Org->id
        ]);
        dd($output->getContent());
        $output->assertRedirect();
        dd('sdfsdfsd');

        $t = Teacher::query()->where('first_name', $name)->first();
        $this->assertNull($t);
    }

    public function setupOrgStructure(User $superAdmin, string $orgName = 'org 1'): Org
    {
        $output = $this->actingAs($superAdmin)->post('/org', [
            'name' => $orgName,
            'level_type' => Org::ORG_LEVEL_TYPE_STATE,
        ]);

        $output->assertRedirect();

        /** @var Org $org */
        $org = Org::query()->where('name', $orgName)->first();

        return $org;
    }


    private function getUserWithRole(string $roleName): User
    {
        $cnu = new CreateNewUser();
        /** @var User $u */
        $u = $cnu->create(
            [
                'email' => 'superadmin'.microtime(true).'@example.com', 'name' => 'superadmin1',
                'password' => '123123123',
                'password_confirmation' => '123123123',
                'terms' => true,
            ]
        );
        $u->assignRole(Role::findByName($roleName));

        return $u;
    }

}
