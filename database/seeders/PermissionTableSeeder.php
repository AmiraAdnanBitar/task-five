<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'create-account',
            'login-account',
            'add-book-to-favorite',
            'Set-rating-book',

            'Creat-main-category',
            'delete-main-category',
            'Creat-sub-category',
            'delete-sub-category',
            
            'Adding-books-with-category',
        
            'See-books',
            'Filter-main-category',
            'Filter-secondary-category',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}