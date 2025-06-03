<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */    public function run(): void
    {
        // Create default admin user
        User::firstOrCreate(
            ['email' => 'admin@cslearning.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // Create default lecturer users
        User::firstOrCreate(
            ['email' => 'john.smith@cslearning.com'],
            [
                'name' => 'Dr. John Smith',
                'password' => Hash::make('lecturer123'),
                'role' => 'lecturer',
                'email_verified_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['email' => 'sarah.johnson@cslearning.com'],
            [
                'name' => 'Prof. Sarah Johnson',
                'password' => Hash::make('lecturer123'),
                'role' => 'lecturer',
                'email_verified_at' => now(),
            ]
        );

        // Create default student users
        User::firstOrCreate(
            ['email' => 'alice.cooper@student.cslearning.com'],
            [
                'name' => 'Alice Cooper',
                'password' => Hash::make('student123'),
                'role' => 'student',
                'email_verified_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['email' => 'bob.wilson@student.cslearning.com'],
            [
                'name' => 'Bob Wilson',
                'password' => Hash::make('student123'),
                'role' => 'student',
                'email_verified_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['email' => 'charlie.brown@student.cslearning.com'],
            [
                'name' => 'Charlie Brown',
                'password' => Hash::make('student123'),
                'role' => 'student',
                'email_verified_at' => now(),
            ]
        );

        echo "✅ Sample users created successfully!\n";
        echo "📧 Admin: admin@cslearning.com / admin123\n";
        echo "👨‍🏫 Lecturer: john.smith@cslearning.com / lecturer123\n";
        echo "🎓 Student: alice.cooper@student.cslearning.com / student123\n";
    }
}
