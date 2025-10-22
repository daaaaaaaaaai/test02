<?php

namespace Database\Seeders\Masters;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Masters\Material;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Material::create([
            'material_code'=>'sample',
            'material_name'=>'隼ＨＡＹＡＢＵＳＡ',
            'class_code'=>'001001',
            'model'=>'GSX1300RRQM5',
            'engine'=>'1339',
            'coo'=>'JP',
            'unit'=>'UN',
            'payment_type'=>'05',
            'cali_type'=>'04',
            'theft_type'=>'02',
            'cr1_type1'=>'01',
            'cr1_type2'=>'04',
            'zrex_type'=>'01',
            'zrmt_type'=>'02',
            'color_code01'=>'C0T',
            'color_code02'=>'BLG',
            'color_code03'=>'ASU',
            'color_code04'=>'',
            'color_code05'=>'',
            'text_material' => '商品テキスト',
            'remarks_material' => '商品備考',
            'created_by' => 'admin',
            'changed_by' => 'admin',
        ]);
    }
}
