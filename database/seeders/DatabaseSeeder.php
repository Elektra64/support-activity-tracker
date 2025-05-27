<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Activity;
use App\Models\ActivityUpdate;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'John Smith',
            'email' => 'admin@npontu.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
            'department' => 'Management',
            'phone' => '1234567890',
            'bio' => 'System Administrator'
        ]);

        // Create regular users first
        $users = [
            ['Michael Johnson', 'michael@example.com', 'Technical Support'],
            ['Sarah Williams', 'sarah@example.com', 'Customer Service'],
            ['David Brown', 'david@example.com', 'Technical Support'],
            ['Emma Davis', 'emma@example.com', 'Customer Service'],
            ['James Wilson', 'james@example.com', 'Technical Support'],
            ['Lisa Anderson', 'lisa@example.com', 'Customer Service'],
            ['Robert Taylor', 'robert@example.com', 'Technical Support'],
            ['Jennifer Martinez', 'jennifer@example.com', 'Customer Service'],
            ['William Thompson', 'william@example.com', 'Technical Support'],
        ];

        foreach ($users as $user) {
            User::create([
                'name' => $user[0],
                'email' => $user[1],
                'password' => Hash::make('password'),
                'is_admin' => false,
                'department' => $user[2],
                'phone' => '1234567890',
                'bio' => 'Support Team Member'
            ]);
        }

        // Create activities and assign them to users through pivot table
        $activities = [
            [
                'Server Maintenance',
                'Weekly server maintenance including updates, security patches, and performance optimization'
            ],
            [
                'Customer Support Queue', 
                'Monitor and manage incoming customer support tickets in the queue system'
            ],
            [
                'Database Backup',
                'Perform daily database backups and verify backup integrity'
            ],
            [
                'Email System Check',
                'Regular monitoring of email system performance and spam filters'
            ],
            [
                'Network Security Audit',
                'Conduct comprehensive security audit of network infrastructure'
            ],
            [
                'User Training Session',
                'Prepare and conduct new user orientation and system training'
            ],
            [
                'System Updates',
                'Deploy and test system updates across all departments'
            ],
            [
                'Bug Fixes',
                'Address reported software issues and implement fixes'
            ],
            [
                'Performance Monitoring',
                'Monitor system performance metrics and optimize where needed'
            ],
            [
                'Documentation Update',
                'Review and update system documentation and user guides'
            ]
        ];

        foreach ($activities as $index => $activity) {
            $newActivity = Activity::create([
                'title' => $activity[0],
                'description' => $activity[1],
                'user_id' => ($index % 9) + 1,
            ]);

            // Assign activity to multiple users through pivot table
            $userIds = [($index % 9) + 1, (($index + 1) % 9) + 1];
            $newActivity->assignedUsers()->attach($userIds);
        }

        // Create activity updates
        Activity::all()->each(function ($activity) {
            for ($i = 0; $i < 10; $i++) {
                $status = rand(0, 1) ? 'Done' : 'Pending';
                $updateText = $status === 'Pending' 
                    ? "In progress: {$activity->title} - Currently working on phase " . ($i + 1)
                    : "Completed: {$activity->title} - Phase " . ($i + 1) . " finished";

                ActivityUpdate::create([
                    'activity_id' => $activity->id,
                    'user_id' => $activity->user_id,
                    'remarks' => $updateText,
                    'status' => $status,
                    'bio_snapshot' => 'Support Team Member',
                    'created_at' => now()->subDays(rand(1, 30)),
                    'updated_at' => now()->subDays(rand(1, 30))
                ]);
            }
        });
    }
}
