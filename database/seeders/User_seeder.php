<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class User_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create($this->userDate());
    }

    public function userDate()
    {
        return [
            'name' => "mah",
            'email' => "mahmoud@gmail.com",
            'password' => Hash::make("12345678"),
            'image' =>'user_imag/fake.png',
            'rule_id' => 1
        ];
    }
}


