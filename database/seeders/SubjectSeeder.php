<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subject::create([
            'name' => 'Database Systems',
        ]);
        Subject::create([
            'name' => 'Algorithm and Programming',
        ]);
        Subject::create([
            'name' => 'Data Structures',
        ]);
        Subject::create([
            'name' => 'Computer Networks',
        ]);
        Subject::create([
            'name' => 'Software Engineering',
        ]);
        Subject::create([
            'name' => 'Operating Systems',
        ]);
    }
}
