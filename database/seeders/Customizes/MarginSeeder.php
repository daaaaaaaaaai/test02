<?php

namespace Database\Seeders\Customizes;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customizes\Margin;

class MarginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Margin::create(['type'=>'01','rate'=>'16.0','created_by'=>'admin','changed_by'=>'admin',]);
        Margin::create(['type'=>'02','rate'=>'16.0','created_by'=>'admin','changed_by'=>'admin',]);
    }
}
