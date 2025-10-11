<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        \App\Models\Classification::create([
            'class_code'=>'001001',
            'class_name'=>'大型',
            'created_by'=>'admin',
            'changed_by'=>'admin',
        ]);
        \App\Models\Classification::create([
            'class_code'=>'001002',
            'class_name'=>'中型',
            'created_by'=>'admin',
            'changed_by'=>'admin',
        ]);
        \App\Models\Classification::create([
            'class_code'=>'001003',
            'class_name'=>'小型',
            'created_by'=>'admin',
            'changed_by'=>'admin',
        ]);
        \App\Models\Classification::create([
            'class_code'=>'002001',
            'class_name'=>'部品',
            'created_by'=>'admin',
            'changed_by'=>'admin',
        ]);
        \App\Models\Classification::create([
            'class_code'=>'009001',
            'class_name'=>'サービス',
            'created_by'=>'admin',
            'changed_by'=>'admin',
        ]);
        \App\Models\Classification::create([
            'class_code'=>'999001',
            'class_name'=>'その他',
            'created_by'=>'admin',
            'changed_by'=>'admin',
        ]);
    }
}
