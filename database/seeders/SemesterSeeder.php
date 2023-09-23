<?php

namespace Database\Seeders;

use App\Models\Semester;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $semesters=[
            '1st Semester',
            '2nd Semester',
            '3rd Semester',
            '4th Semester',
            '5th Semester',
            '6th Semester',
            '7th Semester',
            '8th Semester',
        ];

        foreach($semesters as $semester){
            Semester::create([
                'semester_name'=>$semester,
                'slug'=>Str::slug($semester),
            ]);
        }
    }
}
