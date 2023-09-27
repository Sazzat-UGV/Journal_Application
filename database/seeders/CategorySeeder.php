<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            "Artificial Intelligence",
            "Machine Learning",
            "Data Science",
            "Computer Science",
            "Medicine and Healthcare",
            "Environmental Science",
            "Psychology",
            "Economics",
            "Social Sciences",
            "Engineering",
            "Physics",
            "Chemistry",
            "Biology",
            "Mathematics",
            "Education",
            "History",
            "Literature",
            "Philosophy",
            "Political Science",
            "Sociology",
            "Business and Management",
            "Astronomy",
            "Geology",
            "Anthropology",
            "Law",
            "Music",
            "Art and Design",
        ];

        foreach ($categories as $category) {
            Category::create([
                'category_name' => $category,
                'category_slug' => Str::slug($category)
            ]);
        }
    }
}
