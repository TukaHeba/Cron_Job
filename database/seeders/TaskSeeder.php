<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::create([
            'title' => 'Fix bug in authentication',
            'description' => 'Resolve the login bug for the application.',
            'status' => 'completed',
            'due_date' => '2024-10-15',
            'assigned_to' => 3,
            'created_by' => 1,
        ]);

        Task::create([
            'title' => 'Design new homepage layout',
            'description' => 'Create a new modern design for the homepage.',
            'status' => 'pending',
            'due_date' => '2024-11-01',
            'assigned_to' => 4,
            'created_by' => 1,
        ]);

        Task::create([
            'title' => 'Write documentation for API',
            'description' => 'Complete the API documentation for the developers.',
            'status' => 'completed',
            'due_date' => '2024-10-20',
            'assigned_to' => 2,
            'created_by' => 1,
        ]);

        Task::create([
            'title' => 'Implement user profile feature',
            'description' => 'Develop a feature that allows users to edit their profiles.',
            'status' => 'pending',
            'due_date' => '2024-12-05',
            'assigned_to' => 3,
            'created_by' => 2,
        ]);

        Task::create([
            'title' => 'Test payment gateway integration',
            'description' => 'Perform tests on the integrated payment gateway for bugs.',
            'status' => 'completed',
            'due_date' => '2024-09-25',
            'assigned_to' => 3,
            'created_by' => 2,
        ]);

        Task::create([
            'title' => 'Optimize database queries',
            'description' => 'Improve performance by optimizing complex queries.',
            'status' => 'pending',
            'due_date' => '2024-11-30',
            'assigned_to' => 4,
            'created_by' => 1,
        ]);
    }
}
