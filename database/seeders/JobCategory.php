<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobCategory extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Web Development',
            'Mobile App Development',
            'Front-end Development',
            'Back-end Development',
            'Full-Stack Development',
            'Database Administration',
            'DevOps',
            'UI/UX Design',
            'Game Development',
            'Machine Learning',
            'Data Science',
            'Cybersecurity',
            'Cloud Computing',
            'Network Administration',
            'Quality Assurance (QA)',
            'Embedded Systems',
            'AR/VR Development',
            'IoT Development',
            'Blockchain Development',
            'Digital Marketing',
        ];
        foreach ($categories as $category){
            Category::create(['name' => $category]);
        }
    }
}
