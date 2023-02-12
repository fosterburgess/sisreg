<?php

namespace Database\Seeders;

use App\Models\Constants;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use ReflectionClass;

class RoleSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed some initial roles for testing
     * Take all ROLE_ constants from Constants.php and create role entries
     */
    public function run(): void
    {
        $class = new ReflectionClass(Constants::class);
        $roleConstants = collect($class->getConstants())->filter(function($val, $key) {
            return str_starts_with($key, "ROLE_");
        });
        foreach($roleConstants as $k=>$v) {
            Role::findOrCreate($v);
        }
    }
}
