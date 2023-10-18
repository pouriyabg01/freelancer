<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            'Microsoft Office Suite',
            'Adobe Creative Cloud (Photoshop, Illustrator, InDesign, etc.)',
            'Autodesk AutoCAD',
            'Microsoft Excel',
            'Google Workspace (G Suite)',
            'Microsoft PowerPoint',
            'Adobe Acrobat',
            'Microsoft Word',
            'MATLAB',
            'SketchUp',
            'Rhinoceros 3D',
            'Final Cut Pro',
            'Visual Studio Code',
            'Git',
            'Google Analytics',
            'Mailchimp',
            'JavaScript',
            'Python',
            'Java',
            'C++',
            'Ruby',
            'PHP',
            'Swift',
            'Go',
            'C#',
            'Rust',
        ];
        foreach ($skills as $skill){
            Skill::create(['name' => $skill]);
        }
    }
}
