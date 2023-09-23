<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            'Social Science' => 'Social Science',
            'Mathematics' => 'Mathematics',
            'Physics & Astronomy' => 'Physics & Astronomy',
            'English' => 'English',
            'Business Administration' => 'Business Administration',
            'Mechanical' => 'Mechanical Engineering',
            'Civil' => 'Civil Engineering',
            'EEE' => 'Electrical and Electronics Engineering',
            'CSE' => 'Computer Science and Engineering',
        ];

        foreach ($departments as $key => $value) {

            Department::create([
                'name' => $key,
                'full_name' => $value,
                'slug' => Str::slug($key),
            ]);
        }
    }
}
