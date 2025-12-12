<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = [
            'users'    => ['view', 'create', 'edit', 'delete'],
            'products' => ['view', 'create', 'edit', 'delete'],
            'orders'   => ['view', 'edit'],
            'categorys'  => ['view', 'create', 'edit', 'delete'],
            'roles'  => ['view', 'create', 'edit', 'delete'],
        ];

        foreach ($modules as $module => $actions) {
            foreach ($actions as $action) {
                // dd($module.$action);
                Permission::firstOrCreate(['name' => "$module.$action"]);
            }
        }
    }
}
