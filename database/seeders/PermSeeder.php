<?php

namespace Database\Seeders;

use App\Models\Constants;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use ReflectionClass;
use Spatie\Permission\Models\Permission;

class PermSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed some initial roles for testing
     * Take all ROLE_ constants from Constants.php and create role entries
     */
    public function run(): void
    {
        $class = new ReflectionClass(Constants::class);
        $constants = collect($class->getConstants())->filter(function($val, $key) {
            return str_starts_with($key, "PERM_");
        });
        foreach($constants as $k=>$v) {
            Permission::findOrCreate($v);
        }
    }
}
