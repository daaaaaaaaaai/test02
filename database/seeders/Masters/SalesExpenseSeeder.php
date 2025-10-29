<?php

namespace Database\Seeders\Masters;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Masters\SalesExpense;

class SalesExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        SalesExpense::create(['type'=>'01','start_date'=>'2025-04-01','dlv_pre'=>'15000','weight_tax'=>'0','reg_stamp'=>'0','license_plate'=>'0','license_plate_cost'=>'0','setup_cost'=>'0','created_by'=>'admin','changed_by'=>'admin',]);
        SalesExpense::create(['type'=>'02','start_date'=>'2025-04-01','dlv_pre'=>'17000','weight_tax'=>'0','reg_stamp'=>'0','license_plate'=>'0','license_plate_cost'=>'0','setup_cost'=>'0','created_by'=>'admin','changed_by'=>'admin',]);
        SalesExpense::create(['type'=>'03','start_date'=>'2025-04-01','dlv_pre'=>'37000','weight_tax'=>'4900','reg_stamp'=>'0','license_plate'=>'540','license_plate_cost'=>'535','setup_cost'=>'0','created_by'=>'admin','changed_by'=>'admin',]);
        SalesExpense::create(['type'=>'04','start_date'=>'2025-04-01','dlv_pre'=>'42000','weight_tax'=>'5700','reg_stamp'=>'1400','license_plate'=>'540','license_plate_cost'=>'535','setup_cost'=>'0','created_by'=>'admin','changed_by'=>'admin',]);
        SalesExpense::create(['type'=>'05','start_date'=>'2025-04-01','dlv_pre'=>'45000','weight_tax'=>'5700','reg_stamp'=>'1400','license_plate'=>'540','license_plate_cost'=>'535','setup_cost'=>'670','created_by'=>'admin','changed_by'=>'admin',]);
    }
}
