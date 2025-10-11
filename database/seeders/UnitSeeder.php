<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        \App\Models\Unit::create([
            'unit'=>'UN',
            'text'=>'台',
            'dimension'=>'AAAADL',
            'iso_code'=>'',
            'decimals'=>'0',
            'created_by' => 'admin',
            'changed_by' => 'admin',
        ]);
        \App\Models\Unit::create([
            'unit'=>'µL',
            'text'=>'マイクロリットル',
            'dimension'=>'VOLUME',
            'iso_code'=>'4G',
            'decimals'=>'3',
            'created_by' => 'admin',
            'changed_by' => 'admin',
        ]);
        \App\Models\Unit::create([
            'unit'=>'BAG',
            'text'=>'袋',
            'dimension'=>'AAAADL',
            'iso_code'=>'BG',
            'decimals'=>'0',
            'created_by' => 'admin',
            'changed_by' => 'admin',
        ]);
        \App\Models\Unit::create([
            'unit'=>'CM',
            'text'=>'センチメートル',
            'dimension'=>'LENGTH',
            'iso_code'=>'CMT',
            'decimals'=>'2',
            'created_by' => 'admin',
            'changed_by' => 'admin',
        ]);
        \App\Models\Unit::create([
            'unit'=>'CV',
            'text'=>'ケース',
            'dimension'=>'AAAADL',
            'iso_code'=>'CS',
            'decimals'=>'0',
            'created_by' => 'admin',
            'changed_by' => 'admin',
        ]);
        \App\Models\Unit::create([
            'unit'=>'CL',
            'text'=>'センチリットル',
            'dimension'=>'VOLUME',
            'iso_code'=>null,
            'decimals'=>'3',
            'created_by' => 'admin',
            'changed_by' => 'admin',
        ]);
        \App\Models\Unit::create([
            'unit'=>'DR',
            'text'=>'ドラム',
            'dimension'=>'AAAADL',
            'iso_code'=>'DR',
            'decimals'=>'0',
            'created_by' => 'admin',
            'changed_by' => 'admin',
        ]);
        \App\Models\Unit::create([
            'unit'=>'DZ',
            'text'=>'ダース',
            'dimension'=>'AAAADL',
            'iso_code'=>'DZN',
            'decimals'=>'0',
            'created_by' => 'admin',
            'changed_by' => 'admin',
        ]);
        \App\Models\Unit::create([
            'unit'=>'G',
            'text'=>'グラム',
            'dimension'=>'MASS',
            'iso_code'=>'GRM',
            'decimals'=>'3',
            'created_by' => 'admin',
            'changed_by' => 'admin',
        ]);
        \App\Models\Unit::create([
            'unit'=>'CAR',
            'text'=>'カートン',
            'dimension'=>'AAAADL',
            'iso_code'=>'CT',
            'decimals'=>'0',
            'created_by' => 'admin',
            'changed_by' => 'admin',
        ]);
        \App\Models\Unit::create([
            'unit'=>'KG',
            'text'=>'キログラム',
            'dimension'=>'MASS',
            'iso_code'=>'KGM',
            'decimals'=>'3',
            'created_by' => 'admin',
            'changed_by' => 'admin',
        ]);
        \App\Models\Unit::create([
            'unit'=>'KM',
            'text'=>'キロメートル',
            'dimension'=>'LENGTH',
            'iso_code'=>'KMT',
            'decimals'=>'2',
            'created_by' => 'admin',
            'changed_by' => 'admin',
        ]);
        \App\Models\Unit::create([
            'unit'=>'L',
            'text'=>'リットル',
            'dimension'=>'VOLUME',
            'iso_code'=>'LTR',
            'decimals'=>'3',
            'created_by' => 'admin',
            'changed_by' => 'admin',
        ]);
        \App\Models\Unit::create([
            'unit'=>'M',
            'text'=>'メートル',
            'dimension'=>'LENGTH',
            'iso_code'=>'MTR',
            'decimals'=>'2',
            'created_by' => 'admin',
            'changed_by' => 'admin',
        ]);
        \App\Models\Unit::create([
            'unit'=>'MG',
            'text'=>'ミリグラム',
            'dimension'=>'MASS',
            'iso_code'=>'MGM',
            'decimals'=>'3',
            'created_by' => 'admin',
            'changed_by' => 'admin',
        ]);
        \App\Models\Unit::create([
            'unit'=>'ML',
            'text'=>'ミリリットル',
            'dimension'=>'VOLUME',
            'iso_code'=>'MLT',
            'decimals'=>'3',
            'created_by' => 'admin',
            'changed_by' => 'admin',
        ]);
        \App\Models\Unit::create([
            'unit'=>'MM',
            'text'=>'ミリメートル',
            'dimension'=>'LENGTH',
            'iso_code'=>'MMT',
            'decimals'=>'2',
            'created_by' => 'admin',
            'changed_by' => 'admin',
        ]);
        \App\Models\Unit::create([
            'unit'=>'PAC',
            'text'=>'パック',
            'dimension'=>'AAAADL',
            'iso_code'=>'PK',
            'decimals'=>'0',
            'created_by' => 'admin',
            'changed_by' => 'admin',
        ]);
        \App\Models\Unit::create([
            'unit'=>'ROL',
            'text'=>'巻',
            'dimension'=>'AAAADL',
            'iso_code'=>'RO',
            'decimals'=>'0',
            'created_by' => 'admin',
            'changed_by' => 'admin',
        ]);
        \App\Models\Unit::create([
            'unit'=>'PC',
            'text'=>'個',
            'dimension'=>'AAAADL',
            'iso_code'=>'PCE',
            'decimals'=>'0',
            'created_by' => 'admin',
            'changed_by' => 'admin',
        ]);
        \App\Models\Unit::create([
            'unit'=>'T',
            'text'=>'トン',
            'dimension'=>'MASS',
            'iso_code'=>'TNE',
            'decimals'=>'3',
            'created_by' => 'admin',
            'changed_by' => 'admin',
        ]);
        \App\Models\Unit::create([
            'unit'=>'ST',
            'text'=>'式',
            'dimension'=>'AAAADL',
            'iso_code'=>'SET',
            'decimals'=>'0',
            'created_by' => 'admin',
            'changed_by' => 'admin',
        ]);
    }
}
