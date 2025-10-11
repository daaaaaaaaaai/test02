<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Hash化用に必要
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        \App\Models\User::create([
            'user_id'=>'admin',
            'name_last'=>'管理者',
            'name'=>'管理者',
            'authority' => 'administrator',
            'password'=>Hash::make('daidai_admin'),
        ]);
    }
}
