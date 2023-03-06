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
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name" => "Alaa Super Admin",
            "username" => "alaa_admin",
            "password" => Hash::make("123456"),
            "is_admin" => 1,
            "expire_at" => null,
        ]);
    }
}
