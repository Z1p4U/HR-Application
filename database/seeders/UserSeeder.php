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
            "position" => "admin",
            "phone" => "09791314792",
            "role" => "admin",
            "jd" => "This is Admin JD",
            "annual_leave" => 0,
            "casual_leave" => 0,
            "probation_leave" => 0,
            "unpaid_leave" => 0,
            "agree" => true,
            "password" => Hash::make("asdffdsa"),
        ]);

        User::factory()->create([
            "name" => "Thant Zin",
            "email" => "thantzinhtet2001@gmail.com",
            "position" => "Developer",
            "phone" => "09791314792",
            "role" => "admin",
            "jd" => "This is Developer JD",
            "annual_leave" => 0,
            "casual_leave" => 0,
            "probation_leave" => 0,
            "unpaid_leave" => 0,
            "agree" => true,
            "password" => Hash::make("asdffdsa"),
        ]);
    }
}
