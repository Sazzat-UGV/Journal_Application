<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminDashboardPermissionArray = [
            'Access Dashboard',
        ];
        $adminPermissionArray = [
            'Index Admin',
            'Create Admin',
            'Edit Admin',
            'View Admin',
            'Delete Admin',
        ];
        $adminRolePermissionArray = [
            'Index Role',
            'Create Role',
            'Edit Role',
        ];


        //Access Dashboard
        $adminDashboardModule = Module::where('module_name', 'Admin Dashboard')->select('id')->first();
        for ($i = 0; $i < count($adminDashboardPermissionArray); $i++) {
            Permission::updateOrCreate([
                'module_id' => $adminDashboardModule->id,
                'permission_name' => $adminDashboardPermissionArray[$i],
                'permission_slug' => Str::slug($adminDashboardPermissionArray[$i]),
            ]);
        }
        //admin management
        $adminPermissionModule = Module::where('module_name', 'System Admin Settings')->select('id')->first();
        for ($i = 0; $i < count($adminPermissionArray); $i++) {
            Permission::updateOrCreate([
                'module_id' => $adminPermissionModule->id,
                'permission_name' => $adminPermissionArray[$i],
                'permission_slug' => Str::slug($adminPermissionArray[$i]),
            ]);
        }

        //role management
        $adminRoleModule = Module::where('module_name', 'System Role Settings')->select('id')->first();
        for ($i = 0; $i < count($adminRolePermissionArray); $i++) {
            Permission::updateOrCreate([
                'module_id' => $adminRoleModule->id,
                'permission_name' => $adminRolePermissionArray[$i],
                'permission_slug' => Str::slug($adminRolePermissionArray[$i]),
            ]);
        }
    }
}
