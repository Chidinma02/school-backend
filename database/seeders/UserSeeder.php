<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   
        //
        public function run()
    {
        User::create([
            'name' => 'Chidimma',
            'email' => 'chidimma@mail.com',
            'password' => Hash::make('password'),
            'role' => 'Admin'
        ]);

        // Create some default teachers and students
        User::create([
            'name' => 'Teacher One',
            'email' => 'teacher1@mail.com',
            'password' => Hash::make('password'),
            'role' => 'Teacher'
        ]);

        User::create([
            'name' => 'Student One',
            'email' => 'student1@mail.com',
            'password' => Hash::make('password'),
            'role' => 'Student'
        ]);
    }

    }

