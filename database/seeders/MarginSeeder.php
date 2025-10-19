<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        \App\Models\Margin::create(['type'=>'01','rate'=>'16.0','created_by'=>'admin','changed_by'=>'admin',]);
        \App\Models\Margin::create(['type'=>'02','rate'=>'16.0','created_by'=>'admin','changed_by'=>'admin',]);
    }
}
