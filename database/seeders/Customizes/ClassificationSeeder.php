<?php

namespace Database\Seeders\Customizes;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customizes\Classification;

class ClassificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Classification::create(['class_code'=>'001','class_name'=>'バイク','created_by'=>'admin','changed_by'=>'admin',]);
        Classification::create(['class_code'=>'002','class_name'=>'パーツ','created_by'=>'admin','changed_by'=>'admin',]);
        Classification::create(['class_code'=>'009','class_name'=>'サービス','created_by'=>'admin','changed_by'=>'admin',]);
        Classification::create(['class_code'=>'999','class_name'=>'その他','created_by'=>'admin','changed_by'=>'admin',]);
    }
}
