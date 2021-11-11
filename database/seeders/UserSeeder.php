<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminMuseum = User::create([
            "name" => "omang",
            "phone" => "+6288219157495",
            "email" => "omang@omang.com",
            "gender" => "male",
            "file_verification_url" => "/",
            "password"=>bcrypt("12341234")
        ]);
        $adminMuseum->assignRole('admin-museum');

        $super = User::create([
            "name" => "mang wahyu",
            "phone" => "+6288219157496",
            "email" => "mangwahyu@gmail.com",
            "gender" => "male",
            "file_verification_url" => "/",
            "password"=>bcrypt("12341234")
        ]);
        $super->assignRole('super');
    }
}
