<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NumberRangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        \App\Models\NumberRange::create([
            'number_range'=>'Customer',
            'number_from'=>'0000000001',
            'number_to'=>'8999999999',
            'number_current'=>'0000000000',
            'text'=>'顧客コード番号範囲',
            'created_by' => 'admin',
            'changed_by' => 'admin',
        ]);
        //
        \App\Models\NumberRange::create([
            'number_range'=>'Material',
            'number_from'=>'000000000000000001',
            'number_to'=>'000000008999999999',
            'number_current'=>'000000000000000000',
            'text'=>'顧客コード番号範囲',
            'created_by' => 'admin',
            'changed_by' => 'admin',
        ]);
        //
        \App\Models\NumberRange::create([
            'number_range'=>'Quotation',
            'number_from'=>'0100000000',
            'number_to'=>'0199999999',
            'number_current'=>'0100000000',
            'text'=>'見積伝票番号範囲',
            'created_by' => 'admin',
            'changed_by' => 'admin',
        ]);
        //
        \App\Models\NumberRange::create([
            'number_range'=>'SalesOrder',
            'number_from'=>'1000000000',
            'number_to'=>'1999999999',
            'number_current'=>'1000000000',
            'text'=>'受注伝票番号範囲',
            'created_by' => 'admin',
            'changed_by' => 'admin',
        ]);
        //
        \App\Models\NumberRange::create([
            'number_range'=>'Invoice',
            'number_from'=>'3000000000',
            'number_to'=>'3999999999',
            'number_current'=>'3000000000',
            'text'=>'請求伝票番号範囲',
            'created_by' => 'admin',
            'changed_by' => 'admin',
        ]);
    }
}
