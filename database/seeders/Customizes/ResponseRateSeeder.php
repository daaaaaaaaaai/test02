<?php

namespace Database\Seeders\Customizes;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customizes\ResponseRate;

class ResponseRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        ResponseRate::create(['response_code'=>'01','start_date'=>'2000-01-01','end_date' => '9999-12-31','response_rate'=>'16.00','text'=>'原付(16%)','created_by' => 'admin','changed_by' => 'admin',]);
        ResponseRate::create(['response_code'=>'02','start_date'=>'2000-01-01','end_date' => '9999-12-31','response_rate'=>'16.00','text'=>'大型(16%)','created_by' => 'admin','changed_by' => 'admin',]);
    }
}
