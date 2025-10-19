<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RemoteCostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        \App\Models\RemoteCost::create(['distance'=>'遠方登録なし','cost'=>'0','created_by'=>'admin','changed_by'=>'admin',]);
        \App\Models\RemoteCost::create(['distance'=>'近距離','cost'=>'3000','created_by'=>'admin','changed_by'=>'admin',]);
        \App\Models\RemoteCost::create(['distance'=>'中距離','cost'=>'5000','created_by'=>'admin','changed_by'=>'admin',]);
        \App\Models\RemoteCost::create(['distance'=>'遠距離','cost'=>'8000','created_by'=>'admin','changed_by'=>'admin',]);
    }
}
