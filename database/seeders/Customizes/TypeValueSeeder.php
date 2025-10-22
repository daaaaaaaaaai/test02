<?php

namespace Database\Seeders\Customizes;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customizes\TypeValue;

class TypeValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        TypeValue::create(['type'=>'01','value'=>'01','text'=>'原付','created_by'=>'admin','changed_by'=>'admin',]);
        TypeValue::create(['type'=>'01','value'=>'02','text'=>'軽二輪','created_by'=>'admin','changed_by'=>'admin',]);
        TypeValue::create(['type'=>'01','value'=>'03','text'=>'小型二輪','created_by'=>'admin','changed_by'=>'admin',]);
        TypeValue::create(['type'=>'01','value'=>'04','text'=>'小型ETC','created_by'=>'admin','changed_by'=>'admin',]);
        TypeValue::create(['type'=>'01','value'=>'05','text'=>'受注生産','created_by'=>'admin','changed_by'=>'admin',]);
        TypeValue::create(['type'=>'02','value'=>'01','text'=>'原付','created_by'=>'admin','changed_by'=>'admin',]);
        TypeValue::create(['type'=>'02','value'=>'02','text'=>'大型','created_by'=>'admin','changed_by'=>'admin',]);
        TypeValue::create(['type'=>'03','value'=>'01','text'=>'原付','created_by'=>'admin','changed_by'=>'admin',]);
        TypeValue::create(['type'=>'03','value'=>'02','text'=>'原付MT','created_by'=>'admin','changed_by'=>'admin',]);
        TypeValue::create(['type'=>'03','value'=>'03','text'=>'軽二輪','created_by'=>'admin','changed_by'=>'admin',]);
        TypeValue::create(['type'=>'03','value'=>'04','text'=>'小型二輪','created_by'=>'admin','changed_by'=>'admin',]);
        TypeValue::create(['type'=>'03','value'=>'05','text'=>'小型ETC','created_by'=>'admin','changed_by'=>'admin',]);
        TypeValue::create(['type'=>'04','value'=>'01','text'=>'原付','created_by'=>'admin','changed_by'=>'admin',]);
        TypeValue::create(['type'=>'04','value'=>'03','text'=>'軽二輪','created_by'=>'admin','changed_by'=>'admin',]);
        TypeValue::create(['type'=>'04','value'=>'04','text'=>'小型二輪','created_by'=>'admin','changed_by'=>'admin',]);
        TypeValue::create(['type'=>'05','value'=>'01','text'=>'原付','created_by'=>'admin','changed_by'=>'admin',]);
        TypeValue::create(['type'=>'05','value'=>'02','text'=>'原付MT','created_by'=>'admin','changed_by'=>'admin',]);
        TypeValue::create(['type'=>'05','value'=>'03','text'=>'軽二輪','created_by'=>'admin','changed_by'=>'admin',]);
        TypeValue::create(['type'=>'05','value'=>'04','text'=>'小型二輪','created_by'=>'admin','changed_by'=>'admin',]);
        TypeValue::create(['type'=>'05','value'=>'05','text'=>'小型ETC','created_by'=>'admin','changed_by'=>'admin',]);
        TypeValue::create(['type'=>'06','value'=>'01','text'=>'可','created_by'=>'admin','changed_by'=>'admin',]);
        TypeValue::create(['type'=>'06','value'=>'02','text'=>'不可','created_by'=>'admin','changed_by'=>'admin',]);
        TypeValue::create(['type'=>'07','value'=>'01','text'=>'1000cc以上','created_by'=>'admin','changed_by'=>'admin',]);
        TypeValue::create(['type'=>'07','value'=>'02','text'=>'750cc以上999cc以下','created_by'=>'admin','changed_by'=>'admin',]);
        TypeValue::create(['type'=>'07','value'=>'03','text'=>'400cc以上749cc以下','created_by'=>'admin','changed_by'=>'admin',]);
        TypeValue::create(['type'=>'07','value'=>'04','text'=>'125cc以上399cc以下','created_by'=>'admin','changed_by'=>'admin',]);
        TypeValue::create(['type'=>'07','value'=>'05','text'=>'124cc以下','created_by'=>'admin','changed_by'=>'admin',]);
        TypeValue::create(['type'=>'08','value'=>'01','text'=>'オフロード','created_by'=>'admin','changed_by'=>'admin',]);
        TypeValue::create(['type'=>'08','value'=>'02','text'=>'スクーター','created_by'=>'admin','changed_by'=>'admin',]);
        TypeValue::create(['type'=>'08','value'=>'03','text'=>'ネイキッド','created_by'=>'admin','changed_by'=>'admin',]);
        TypeValue::create(['type'=>'08','value'=>'04','text'=>'フルカウル','created_by'=>'admin','changed_by'=>'admin',]);
        TypeValue::create(['type'=>'09','value'=>'01','text'=>'車検車','created_by'=>'admin','changed_by'=>'admin',]);
        TypeValue::create(['type'=>'09','value'=>'02','text'=>'非車検車','created_by'=>'admin','changed_by'=>'admin',]);
        TypeValue::create(['type'=>'10','value'=>'01','text'=>'原付','created_by'=>'admin','changed_by'=>'admin',]);
        TypeValue::create(['type'=>'10','value'=>'02','text'=>'自二(スズキ)','created_by'=>'admin','changed_by'=>'admin',]);
    }
}
