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
            "phone" => "0988998899",
            "role" => "admin",
            "jd" => "abcdefghijklmnopqrstuvwxyz",
            "annual_leave" => 10,
            "casual_leave" => 8,
            "probation_leave" => 3,
            "unpaid_leave" => 2,
            "agree" => true,
            "password" => Hash::make("asdffdsa"),
        ]);

        User::factory()->create([
            "name" => "permanent",
            "email" => "permanent@gmail.com",
            "position" => "Content Creator",
            "phone" => "0999887766",
            "role" => "permanent",
            "jd" => "abcdefghijklmnopqrstuvwxyz",
            "annual_leave" => 10,
            "casual_leave" => 8,
            "probation_leave" => 3,
            "unpaid_leave" => 2,
            "agree" => true,
            "password" => Hash::make("asdffdsa"),
        ]);

        User::factory()->create([
            "name" => "probation",
            "email" => "probation@gmail.com",
            "position" => "Graphic Designer",
            "phone" => "0944332211",
            "jd" => "abcdefghijklmnopqrstuvwxyz",
            "annual_leave" => 10,
            "casual_leave" => 8,
            "probation_leave" => 3,
            "unpaid_leave" => 2,
            "role" => "probation",
            "agree" => true,
            "password" => Hash::make("asdffdsa"),
        ]);
    }
}
