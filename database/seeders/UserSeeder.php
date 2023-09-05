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
    public function run(): void
    {
        User::factory()->create([
            "name" => "admin",
            "email" => "admin@gmail.com",
            "position" => "Founder",
            "role" => "admin",
            "agree" => false,
            "password" => Hash::make("asdffdsa"),
        ]);

        User::factory()->create([
            "name" => "permanent",
            "email" => "permanent@gmail.com",
            "position" => "Content Creator",
            "role" => "permanent",
            "agree" => false,
            "password" => Hash::make("asdffdsa"),
        ]);

        User::factory()->create([
            "name" => "probation",
            "email" => "probation@gmail.com",
            "position" => "Graphic Designer",
            "role" => "probation",
            "agree" => false,
            "password" => Hash::make("asdffdsa"),
        ]);
    }
}
