<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $module_array = [
            'Admin Dashboard',
            'System Admin Settings',
            'System Role Settings',
            'Department Management',
            'Semester Management',
            'User Managements',
            'System Settings',
            'Category Management'
        ];

        foreach ($module_array as $module) {
            Module::updateOrCreate([
                'module_name' => $module,
                'module_slug' => Str::slug($module),
            ]);
        }
    }
}
