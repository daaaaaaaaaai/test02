<?php

namespace Database\Seeders\Customizes;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customizes\RemoteCost;

class RemoteCostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        RemoteCost::create(['distance'=>'遠方登録なし','cost'=>'0','created_by'=>'admin','changed_by'=>'admin',]);
        RemoteCost::create(['distance'=>'近距離','cost'=>'3000','created_by'=>'admin','changed_by'=>'admin',]);
        RemoteCost::create(['distance'=>'中距離','cost'=>'5000','created_by'=>'admin','changed_by'=>'admin',]);
        RemoteCost::create(['distance'=>'遠距離','cost'=>'8000','created_by'=>'admin','changed_by'=>'admin',]);
    }
}
