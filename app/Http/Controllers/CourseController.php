<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function showCourse($course)
    {
        // Define course information
        $courses = [
            'database-systems' => [
                'title' => 'Database Systems',
                'icon' => 'fas fa-database',
                'description' => 'Master SQL, database design, normalization, and modern database technologies. Learn to build efficient and scalable data storage solutions.',
                'difficulty' => 3.5,
                'languages' => ['SQL', 'PostgreSQL', 'MongoDB', 'Redis'],
                'details' => [
                    'intro' => 'Database systems are the foundation of modern applications, enabling efficient data storage, retrieval, and management. This course provides a comprehensive introduction to both relational and NoSQL database systems.',
                    'topics' => [
                        'Relational Database Design and Normalization',
                        'SQL Fundamentals and Advanced Queries',
                        'Transaction Processing and Concurrency Control',
                        'Database Security and Authorization',
                        'NoSQL Database Systems (Document, Key-Value, Graph)',
                        'Database Performance Optimization',
                        'Distributed Database Systems'
                    ],
                    'projects' => [
                        'Design and implement a fully normalized database for an e-commerce platform',
                        'Build a data warehouse for business analytics',
                        'Create a high-performance database system with proper indexing'
                    ]
                ]
            ],
            'algorithm-programming' => [
                'title' => 'Algorithm & Programming',
                'icon' => 'fas fa-code',
                'description' => 'Learn fundamental programming concepts, algorithm design, and problem-solving techniques. Build strong coding foundations across multiple languages.',
                'difficulty' => 4.0,
                'languages' => ['Python', 'Java', 'C++', 'JavaScript'],
                'details' => [
                    'intro' => 'This course provides a strong foundation in algorithm design and programming concepts. You\'ll learn how to approach complex problems, design efficient solutions, and implement them using various programming languages.',
                    'topics' => [
                        'Algorithmic Complexity and Big-O Notation',
                        'Sorting and Searching Algorithms',
                        'Divide and Conquer Strategies',
                        'Greedy Algorithms',
                        'Dynamic Programming',
                        'Graph Algorithms',
                        'Object-Oriented Programming Concepts'
                    ],
                    'projects' => [
                        'Implement classic algorithms and analyze their performance',
                        'Build a pathfinding visualization tool',
                        'Develop a recommendation system using advanced algorithms'
                    ]
                ]
            ],
            'data-structures' => [
                'title' => 'Data Structures',
                'icon' => 'fas fa-project-diagram',
                'description' => 'Understand arrays, linked lists, trees, graphs, and hash tables. Learn when and how to use the right data structure for optimal performance.',
                'difficulty' => 4.5,
                'languages' => ['Java', 'C++', 'Python'],
                'details' => [
                    'intro' => 'Data structures are the building blocks of efficient software. This course teaches you how to organize and store data for optimal access and modification, enabling you to write high-performance applications.',
                    'topics' => [
                        'Arrays and Linked Lists',
                        'Stacks, Queues, and Priority Queues',
                        'Hash Tables and Hash Functions',
                        'Binary Search Trees and AVL Trees',
                        'Heaps and Heap Sort',
                        'Graphs and Graph Traversal',
                        'Trie and Suffix Tree'
                    ],
                    'projects' => [
                        'Implement a library of advanced data structures',
                        'Build a memory-efficient database index',
                        'Create a real-time data processing system'
                    ]
                ]
            ],
            'computer-networks' => [
                'title' => 'Computer Networks',
                'icon' => 'fas fa-network-wired',
                'description' => 'Explore network protocols, architecture, security, and distributed systems. Understand how modern internet infrastructure works.',
                'difficulty' => 3.8,
                'languages' => ['Python', 'C', 'Wireshark'],
                'details' => [
                    'intro' => 'Computer networks connect our digital world. This course explores the principles and practices of computer networking, from local networks to the global internet infrastructure.',
                    'topics' => [
                        'Network Architecture and OSI Model',
                        'TCP/IP Protocol Suite',
                        'Routing and Switching Technologies',
                        'Wireless Networks and Mobile Communications',
                        'Network Security and Encryption',
                        'Software-Defined Networking',
                        'Cloud Computing Infrastructure'
                    ],
                    'projects' => [
                        'Build a secure local area network',
                        'Develop a network monitoring tool',
                        'Implement a distributed messaging system'
                    ]
                ]
            ],
            'software-engineering' => [
                'title' => 'Software Engineering',
                'icon' => 'fas fa-cogs',
                'description' => 'Learn software development lifecycle, design patterns, testing methodologies, and project management for building robust applications.',
                'difficulty' => 3.5,
                'languages' => ['Java', 'Python', 'UML', 'Git'],
                'details' => [
                    'intro' => 'Software Engineering transforms programming from an individual activity into a professional, collaborative discipline. This course teaches structured approaches to software development, ensuring quality, maintainability, and scalability.',
                    'topics' => [
                        'Software Development Lifecycle Models',
                        'Requirements Engineering and Analysis',
                        'Software Architecture and Design Patterns',
                        'Testing Methodologies and Test-Driven Development',
                        'Continuous Integration and Deployment',
                        'Agile Development Methodologies',
                        'Software Project Management and Team Collaboration'
                    ],
                    'projects' => [
                        'Develop a complete software project using Agile methodologies',
                        'Create a continuous integration pipeline',
                        'Design and implement a system using modern design patterns'
                    ]
                ]
            ],
            'operating-systems' => [
                'title' => 'Operating Systems',
                'icon' => 'fas fa-desktop',
                'description' => 'Understand process management, memory allocation, file systems, and system calls. Learn how operating systems manage computer resources.',
                'difficulty' => 4.7,
                'languages' => ['C', 'Assembly', 'Bash'],
                'details' => [
                    'intro' => 'Operating systems are the foundation of all computer software. This course dives into the complex world of OS design, exploring how modern operating systems manage hardware resources and provide services to applications.',
                    'topics' => [
                        'Process Management and Scheduling',
                        'Memory Management and Virtual Memory',
                        'File Systems and Storage Management',
                        'Input/Output Systems and Device Drivers',
                        'Concurrency and Synchronization',
                        'System Security and Protection',
                        'Virtualization and Containerization'
                    ],
                    'projects' => [
                        'Implement a simple shell with core functionalities',
                        'Develop a basic thread scheduler',
                        'Create a virtual memory management system'
                    ]
                ]
            ]
        ];
        
        // Check if the requested course exists
        if (!array_key_exists($course, $courses)) {
            abort(404);
        }
        
        return view('courses.detail', [
            'course' => $courses[$course],
            'courseSlug' => $course
        ]);
    }
}
