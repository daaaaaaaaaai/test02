<?php

namespace Database\Seeders\Customizes;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customizes\StatusValue;

class StatusValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        StatusValue::create(['status'=>'Inventory','value'=>'0','text'=>'利用可能在庫','created_by' => 'admin','changed_by' => 'admin',]);
        StatusValue::create(['status'=>'Inventory','value'=>'1','text'=>'検査中','created_by' => 'admin','changed_by' => 'admin',]);
        StatusValue::create(['status'=>'Inventory','value'=>'8','text'=>'商談中','created_by' => 'admin','changed_by' => 'admin',]);
        StatusValue::create(['status'=>'Inventory','value'=>'9','text'=>'売約','created_by' => 'admin','changed_by' => 'admin',]);
    }
}
