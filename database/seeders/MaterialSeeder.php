<?php

namespace Database\Seeders;

use App\Models\Material;
use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get subjects
        $databaseSystems = Subject::where('name', 'Database Systems')->first();
        $algorithmProgramming = Subject::where('name', 'Algorithm and Programming')->first();
        $dataStructures = Subject::where('name', 'Data Structures')->first();
        $computerNetworks = Subject::where('name', 'Computer Networks')->first();
        $softwareEngineering = Subject::where('name', 'Software Engineering')->first();
        $operatingSystems = Subject::where('name', 'Operating Systems')->first();

        // Database Systems Materials
        if ($databaseSystems) {
            Material::create([
                'subject_id' => $databaseSystems->id,
                'title' => 'Introduction to Database Systems',
                'content' => 'This lesson covers the fundamental concepts of database systems, including data models, database design principles, and the importance of databases in modern computing.',
            ]);

            Material::create([
                'subject_id' => $databaseSystems->id,
                'title' => 'SQL Fundamentals',
                'content' => 'Learn the basics of SQL (Structured Query Language) including SELECT, INSERT, UPDATE, DELETE operations, and basic query optimization techniques.',
            ]);

            Material::create([
                'subject_id' => $databaseSystems->id,
                'title' => 'Database Design and Normalization',
                'content' => 'Understand entity-relationship modeling, normalization forms (1NF, 2NF, 3NF), and how to design efficient database schemas.',
            ]);
        }

        // Algorithm and Programming Materials
        if ($algorithmProgramming) {
            Material::create([
                'subject_id' => $algorithmProgramming->id,
                'title' => 'Introduction to Algorithms',
                'content' => 'Learn what algorithms are, how to analyze their efficiency using Big O notation, and understand basic algorithmic thinking patterns.',
            ]);

            Material::create([
                'subject_id' => $algorithmProgramming->id,
                'title' => 'Sorting Algorithms',
                'content' => 'Explore various sorting algorithms including Bubble Sort, Selection Sort, Insertion Sort, Merge Sort, and Quick Sort with their time complexities.',
            ]);

            Material::create([
                'subject_id' => $algorithmProgramming->id,
                'title' => 'Search Algorithms',
                'content' => 'Study linear search, binary search, and hash-based search techniques. Understand when and how to apply each search method effectively.',
            ]);
        }

        // Data Structures Materials
        if ($dataStructures) {
            Material::create([
                'subject_id' => $dataStructures->id,
                'title' => 'Arrays and Linked Lists',
                'content' => 'Compare arrays and linked lists, understand their advantages and disadvantages, and learn when to use each data structure.',
            ]);

            Material::create([
                'subject_id' => $dataStructures->id,
                'title' => 'Stacks and Queues',
                'content' => 'Learn about LIFO (Last In, First Out) and FIFO (First In, First Out) data structures, their implementations, and real-world applications.',
            ]);

            Material::create([
                'subject_id' => $dataStructures->id,
                'title' => 'Trees and Binary Search Trees',
                'content' => 'Understand tree terminology, binary trees, binary search trees, and basic tree traversal algorithms (inorder, preorder, postorder).',
            ]);
        }

        // Computer Networks Materials
        if ($computerNetworks) {
            Material::create([
                'subject_id' => $computerNetworks->id,
                'title' => 'Network Fundamentals',
                'content' => 'Introduction to computer networks, network topologies, OSI model layers, and basic networking concepts.',
            ]);

            Material::create([
                'subject_id' => $computerNetworks->id,
                'title' => 'TCP/IP Protocol Suite',
                'content' => 'Learn about the TCP/IP model, IP addressing, subnetting, and how data flows through the internet.',
            ]);
        }

        // Software Engineering Materials
        if ($softwareEngineering) {
            Material::create([
                'subject_id' => $softwareEngineering->id,
                'title' => 'Software Development Life Cycle',
                'content' => 'Overview of SDLC phases: requirements gathering, design, implementation, testing, deployment, and maintenance.',
            ]);

            Material::create([
                'subject_id' => $softwareEngineering->id,
                'title' => 'Agile Methodology',
                'content' => 'Introduction to Agile principles, Scrum framework, sprint planning, and iterative development approaches.',
            ]);
        }

        // Operating Systems Materials
        if ($operatingSystems) {
            Material::create([
                'subject_id' => $operatingSystems->id,
                'title' => 'Introduction to Operating Systems',
                'content' => 'Learn what operating systems are, their main functions, and different types of operating systems (Windows, Linux, macOS).',
            ]);

            Material::create([
                'subject_id' => $operatingSystems->id,
                'title' => 'Process Management',
                'content' => 'Understand processes, threads, process scheduling algorithms, and how operating systems manage multiple running programs.',
            ]);
        }
    }
}
