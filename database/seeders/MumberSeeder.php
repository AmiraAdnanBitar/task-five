<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class MumberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $role = Role::firstOrCreate(
            ['name' => "manager"], 
            ['name' => "manager"]
        );
        $mumberRole = Role::create([
            'name' => "mumber"
        ]);
        $permissionsString = [1, 2, 3, 4, 10, 11, 12];
        $mumberRole->syncPermissions($permissionsString);
        
        $VisitorRole = Role::create([
            'name' => "visitor"
        ]);
        $permissionsString = [10, 11, 12];
        $VisitorRole->syncPermissions($permissionsString);
    }
}
