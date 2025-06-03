<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\Material;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some existing materials
        $materials = Material::all();
        
        if ($materials->isEmpty()) {
            $this->command->info('No materials found. Please create materials first.');
            return;
        }

        // Data Structures Quiz
        $material1 = $materials->first();
        $quiz1 = Quiz::create([
            'title' => 'Introduction to Data Structures',
            'description' => 'Test your understanding of basic data structures concepts including arrays, linked lists, and stacks.',
            'material_id' => $material1->id,
            'time_limit' => 15,
            'max_attempts' => 2,
            'is_active' => true,
        ]);

        // Quiz 1 Questions
        QuizQuestion::create([
            'quiz_id' => $quiz1->id,
            'question' => 'What is the time complexity of accessing an element in an array by its index?',
            'type' => 'multiple_choice',
            'options' => ['O(1)', 'O(n)', 'O(log n)', 'O(n²)'],
            'correct_answer' => 'A',
            'points' => 2,
            'order' => 1,
        ]);

        QuizQuestion::create([
            'quiz_id' => $quiz1->id,
            'question' => 'A stack follows which principle?',
            'type' => 'multiple_choice',
            'options' => ['FIFO (First In, First Out)', 'LIFO (Last In, First Out)', 'Random Access', 'Sequential Access'],
            'correct_answer' => 'B',
            'points' => 2,
            'order' => 2,
        ]);

        QuizQuestion::create([
            'quiz_id' => $quiz1->id,
            'question' => 'Linked lists provide constant time insertion at the beginning.',
            'type' => 'true_false',
            'options' => null,
            'correct_answer' => 'True',
            'points' => 1,
            'order' => 3,
        ]);

        // Algorithms Quiz
        if ($materials->count() > 1) {
            $material2 = $materials->skip(1)->first();
            $quiz2 = Quiz::create([
                'title' => 'Sorting Algorithms Fundamentals',
                'description' => 'Evaluate your knowledge of common sorting algorithms and their performance characteristics.',
                'material_id' => $material2->id,
                'time_limit' => 20,
                'max_attempts' => 3,
                'is_active' => true,
            ]);

            // Quiz 2 Questions
            QuizQuestion::create([
                'quiz_id' => $quiz2->id,
                'question' => 'Which sorting algorithm has the best average-case time complexity?',
                'type' => 'multiple_choice',
                'options' => ['Bubble Sort', 'Quick Sort', 'Selection Sort', 'Insertion Sort'],
                'correct_answer' => 'B',
                'points' => 3,
                'order' => 1,
            ]);

            QuizQuestion::create([
                'quiz_id' => $quiz2->id,
                'question' => 'Merge sort is a stable sorting algorithm.',
                'type' => 'true_false',
                'options' => null,
                'correct_answer' => 'True',
                'points' => 2,
                'order' => 2,
            ]);

            QuizQuestion::create([
                'quiz_id' => $quiz2->id,
                'question' => 'What is the space complexity of Quick Sort in the worst case?',
                'type' => 'text',
                'options' => null,
                'correct_answer' => 'O(n)',
                'points' => 3,
                'order' => 3,
            ]);

            QuizQuestion::create([
                'quiz_id' => $quiz2->id,
                'question' => 'Which of these is NOT a comparison-based sorting algorithm?',
                'type' => 'multiple_choice',
                'options' => ['Heap Sort', 'Counting Sort', 'Merge Sort', 'Quick Sort'],
                'correct_answer' => 'B',
                'points' => 2,
                'order' => 4,
            ]);
        }

        // Object-Oriented Programming Quiz
        if ($materials->count() > 2) {
            $material3 = $materials->skip(2)->first();
            $quiz3 = Quiz::create([
                'title' => 'OOP Principles and Concepts',
                'description' => 'Test your understanding of object-oriented programming concepts including inheritance, polymorphism, and encapsulation.',
                'material_id' => $material3->id,
                'time_limit' => 25,
                'max_attempts' => 2,
                'is_active' => true,
            ]);

            // Quiz 3 Questions
            QuizQuestion::create([
                'quiz_id' => $quiz3->id,
                'question' => 'Which of the following is NOT a pillar of Object-Oriented Programming?',
                'type' => 'multiple_choice',
                'options' => ['Encapsulation', 'Inheritance', 'Polymorphism', 'Compilation'],
                'correct_answer' => 'D',
                'points' => 2,
                'order' => 1,
            ]);

            QuizQuestion::create([
                'quiz_id' => $quiz3->id,
                'question' => 'Polymorphism allows objects of different types to be treated as objects of a common base type.',
                'type' => 'true_false',
                'options' => null,
                'correct_answer' => 'True',
                'points' => 2,
                'order' => 2,
            ]);

            QuizQuestion::create([
                'quiz_id' => $quiz3->id,
                'question' => 'What does encapsulation help achieve in OOP?',
                'type' => 'text',
                'options' => null,
                'correct_answer' => 'Data hiding',
                'points' => 3,
                'order' => 3,
            ]);

            QuizQuestion::create([
                'quiz_id' => $quiz3->id,
                'question' => 'In inheritance, the class that inherits is called:',
                'type' => 'multiple_choice',
                'options' => ['Parent class', 'Base class', 'Child class', 'Super class'],
                'correct_answer' => 'C',
                'points' => 1,
                'order' => 4,
            ]);

            QuizQuestion::create([
                'quiz_id' => $quiz3->id,
                'question' => 'Abstract classes can be instantiated directly.',
                'type' => 'true_false',
                'options' => null,
                'correct_answer' => 'False',
                'points' => 2,
                'order' => 5,
            ]);
        }

        $this->command->info('Quiz seeder completed! Created ' . Quiz::count() . ' quizzes with questions.');
    }
}
