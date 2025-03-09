<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Status;
use App\Models\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $manager = Role::create(['name' => 'manager']);
        $user = Role::create(['name' => 'user']);

        Status::insert([
            ['name' => 'To Do'],
            ['name' => 'Pending'],
            ['name' => 'Completed'],
            ['name' => 'Canceled'],
        ]);

        User::create([
            'name' => 'Admin Manager',
            'email' => 'admin@manager.com',
            'password' => bcrypt('123456'),
            'role_id' => $manager->id,
        ]);

        User::create([
            'name' => 'Normal User',
            'email' => 'user@test.com',
            'password' => bcrypt('123456'),
            'role_id' => $user->id,
        ]);

        User::create([
            'name' => 'Normal User 2',
            'email' => 'user2@test.com',
            'password' => bcrypt('123456'),
            'role_id' => $user->id,
        ]);
    }
}
