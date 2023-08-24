<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->name = "Luis Perez";
        $user->email = "admin@admin.com";
        $user->password = bcrypt("admin12345");
        $user->email_verified_at = "2023-08-22";
        $user->remember_token = "nNFhKn76Vic";
        $user->save();
    }
}