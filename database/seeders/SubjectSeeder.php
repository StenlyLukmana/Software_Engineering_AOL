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
            'name' => 'Database',
        ]);
        Subject::create([
            'name' => 'Algorithm and Programming',
        ]);
        Subject::create([
            'name' => 'Statistics',
        ]);
        Subject::create([
            'name' => 'Computer Security',
        ]);
    }
}
