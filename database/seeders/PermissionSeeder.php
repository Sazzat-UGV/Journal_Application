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
        $adminDepartmentPermissionArray = [
            'Index Department',
            'Create Department',
            'Edit Department',
            'Delete Department',
        ];
        $adminSemesterPermissionArray = [
            'Index Semester',
            'Create Semester',
            'Edit Semester',
            'Delete Semester',
        ];
        $adminuserManagementPermissionArray = [
            'Index User',
            'View User Profile',
            'View User Publications',
            'Edit User',
            'Delete User',
        ];
        $adminSystemSettingsPermissionArray = [
            'Mail Setting',
        ];
        $adminCategoryManagementPermissionArray = [
            'Index Category',
            'Create Category',
            'Edit Category',
            'Delete Category',
        ];
        $adminBackupManagementPermissionArray = [
            'Index Backup',
            'Create Backup',
            'Delete Backup',
            'Download Backup',
        ];
        $adminPublicationPermissionArray = [
            'Index Publication',
            'View Publication',
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

        //department management
        $adminDepartmentModule = Module::where('module_name', 'Department Management')->select('id')->first();
        for ($i = 0; $i < count($adminDepartmentPermissionArray); $i++) {
            Permission::updateOrCreate([
                'module_id' => $adminDepartmentModule->id,
                'permission_name' => $adminDepartmentPermissionArray[$i],
                'permission_slug' => Str::slug($adminDepartmentPermissionArray[$i]),
            ]);
        }

        //semester management
        $adminSemesterModule = Module::where('module_name', 'Semester Management')->select('id')->first();
        for ($i = 0; $i < count($adminSemesterPermissionArray); $i++) {
            Permission::updateOrCreate([
                'module_id' => $adminSemesterModule->id,
                'permission_name' => $adminSemesterPermissionArray[$i],
                'permission_slug' => Str::slug($adminSemesterPermissionArray[$i]),
            ]);
        }

        //user management
        $adminUserManagemanetModule = Module::where('module_name', 'User Managements')->select('id')->first();
        for ($i = 0; $i < count($adminuserManagementPermissionArray); $i++) {
            Permission::updateOrCreate([
                'module_id' => $adminUserManagemanetModule->id,
                'permission_name' => $adminuserManagementPermissionArray[$i],
                'permission_slug' => Str::slug($adminuserManagementPermissionArray[$i]),
            ]);
        }

        //system setting
        $adminSystemSettingModule = Module::where('module_name', 'System Settings')->select('id')->first();
        for ($i = 0; $i < count($adminSystemSettingsPermissionArray); $i++) {
            Permission::updateOrCreate([
                'module_id' => $adminSystemSettingModule->id,
                'permission_name' => $adminSystemSettingsPermissionArray[$i],
                'permission_slug' => Str::slug($adminSystemSettingsPermissionArray[$i]),
            ]);
        }

        //category management
        $adminCategoryManagementModule = Module::where('module_name', 'Category Management')->select('id')->first();
        for ($i = 0; $i < count($adminCategoryManagementPermissionArray); $i++) {
            Permission::updateOrCreate([
                'module_id' => $adminCategoryManagementModule->id,
                'permission_name' => $adminCategoryManagementPermissionArray[$i],
                'permission_slug' => Str::slug($adminCategoryManagementPermissionArray[$i]),
            ]);
        }
        //backup management
        $adminBackupManagementModule = Module::where('module_name', 'System Backup')->select('id')->first();
        for ($i = 0; $i < count($adminBackupManagementPermissionArray); $i++) {
            Permission::updateOrCreate([
                'module_id' => $adminBackupManagementModule->id,
                'permission_name' => $adminBackupManagementPermissionArray[$i],
                'permission_slug' => Str::slug($adminBackupManagementPermissionArray[$i]),
            ]);
        }
        //publication
        $adminPublicationModule = Module::where('module_name', 'Publications')->select('id')->first();
        for ($i = 0; $i < count($adminPublicationPermissionArray); $i++) {
            Permission::updateOrCreate([
                'module_id' => $adminPublicationModule->id,
                'permission_name' => $adminPublicationPermissionArray[$i],
                'permission_slug' => Str::slug($adminPublicationPermissionArray[$i]),
            ]);
        }
    }
}
