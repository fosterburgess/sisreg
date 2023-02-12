<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Seed the application's test database.
     */
    public function run(): void
    {
        (new RoleSeeder)->run();
        (new PermSeeder)->run();
        (new RolePermSeeder)->run();
    }
}
