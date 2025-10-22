<?php

namespace Database\Seeders\Customizes;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customizes\Type;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Type::create(['type'=>'01','text'=>'車両標準種別','created_by'=>'admin','changed_by'=>'admin',]);
        Type::create(['type'=>'02','text'=>'スズキ店格マージン種別','created_by'=>'admin','changed_by'=>'admin',]);
        Type::create(['type'=>'03','text'=>'新車販売諸経費（乗りだし）種別','created_by'=>'admin','changed_by'=>'admin',]);
        Type::create(['type'=>'04','text'=>'自賠責保険種別','created_by'=>'admin','changed_by'=>'admin',]);
        Type::create(['type'=>'05','text'=>'納準種別','created_by'=>'admin','changed_by'=>'admin',]);
        Type::create(['type'=>'06','text'=>'盗難種別','created_by'=>'admin','changed_by'=>'admin',]);
        Type::create(['type'=>'07','text'=>'CR1種別①','created_by'=>'admin','changed_by'=>'admin',]);
        Type::create(['type'=>'08','text'=>'CR1種別②','created_by'=>'admin','changed_by'=>'admin',]);
        Type::create(['type'=>'09','text'=>'ZR延長種別','created_by'=>'admin','changed_by'=>'admin',]);
        Type::create(['type'=>'10','text'=>'ZR車両種別','created_by'=>'admin','changed_by'=>'admin',]);
    }
}
