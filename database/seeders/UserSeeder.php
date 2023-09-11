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
            "name" => "Admin",
            "email" => "admin@hr.yolodigitalmyanmar.com",
            "position" => "Founder",
            "phone" => "09791314792",
            "role" => "admin",
            "jd" => "",
            "annual_leave" => 0,
            "casual_leave" => 0,
            "probation_leave" => 0,
            "unpaid_leave" => 0,
            "agree" => true,
            "password" => Hash::make("admin321asdffdsa"),
        ]);

        User::factory()->create([
            "name" => "Myo Myint Tun",
            "email" => "myomyinttun.yolodigitalmyanmar@gmail.com",
            "position" => "Senior Graphic Designer",
            "phone" => "09420167540",
            "role" => "permanent",
            "jd" => "",
            "annual_leave" => 10,
            "casual_leave" => 6,
            "probation_leave" => 0,
            "unpaid_leave" => 7,
            "agree" => true,
            "password" => Hash::make("myoMyintTun321"),
        ]);

        User::factory()->create([
            "name" => "Pyone Thet Nwe",
            "email" => "pyonethetnwe5@gmail.com",
            "position" => "Account Executive",
            "phone" => "09955899777",
            "jd" => "",
            "annual_leave" => 0,
            "casual_leave" => 0,
            "probation_leave" => 3,
            "unpaid_leave" => 0,
            "role" => "probation",
            "agree" => true,
            "password" => Hash::make("pyoneThet5"),
        ]);

        User::factory()->create([
            "name" => "Oakkar Min Khant",
            "email" => "oak155248@gmail.com",
            "position" => "Sale",
            "phone" => "09987070478",
            "jd" => "",
            "annual_leave" => 0,
            "casual_leave" => 0,
            "probation_leave" => 3,
            "unpaid_leave" => 0,
            "role" => "probation",
            "agree" => true,
            "password" => Hash::make("oakkarMin155248"),
        ]);

        User::factory()->create([
            "name" => "Han Myo Thu",
            "email" => "hanmyothu906@gmail.com",
            "position" => "Content Writer",
            "phone" => "09787803937",
            "jd" => "",
            "annual_leave" => 0,
            "casual_leave" => 0,
            "probation_leave" => 3,
            "unpaid_leave" => 0,
            "role" => "probation",
            "agree" => true,
            "password" => Hash::make("hanMyo906"),
        ]);

        User::factory()->create([
            "name" => "Su Myat Pwint",
            "email" => "sumyatpwint2000@gmail.com",
            "position" => "Graphic Designer",
            "phone" => "09793891988",
            "jd" => "",
            "annual_leave" => 0,
            "casual_leave" => 0,
            "probation_leave" => 3,
            "unpaid_leave" => 0,
            "role" => "probation",
            "agree" => true,
            "password" => Hash::make("suMyat2000"),
        ]);

        User::factory()->create([
            "name" => "Thant Zin Htet",
            "email" => "thantzinhtet2001@gmail.com",
            "position" => "Web Developer",
            "phone" => "09791643043",
            "jd" => "",
            "annual_leave" => 0,
            "casual_leave" => 0,
            "probation_leave" => 3,
            "unpaid_leave" => 0,
            "role" => "probation",
            "agree" => true,
            "password" => Hash::make("P@s5w0rd"),
        ]);

        User::factory()->create([
            "name" => "Shin Khant",
            "email" => "shinkhantlaybal@gmail.com",
            "position" => "Web Developer",
            "phone" => "09951939130",
            "jd" => "",
            "annual_leave" => 0,
            "casual_leave" => 0,
            "probation_leave" => 3,
            "unpaid_leave" => 0,
            "role" => "probation",
            "agree" => true,
            "password" => Hash::make("asdffdsa"),
        ]);

        User::factory()->create([
            "name" => "Thet Naing Oo",
            "email" => "thetnaingoo.me@gmail.com",
            "position" => "Content Writer",
            "phone" => "09784041805",
            "jd" => "",
            "annual_leave" => 0,
            "casual_leave" => 0,
            "probation_leave" => 3,
            "unpaid_leave" => 0,
            "role" => "probation",
            "agree" => true,
            "password" => Hash::make("thetNaing123"),
        ]);
    }
}
