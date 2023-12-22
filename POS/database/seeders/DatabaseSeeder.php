<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //create admin account
        User::create([
            'name' => 'admin',
            'email'=> 'admin@gmail.com',
            'phone' => '09966170650',
            'gender'=>'male',
            'address' => 'pyinmana',
            'role'=>'admin',
            'password'=>Hash::make('password')

        ]);
    }
}
