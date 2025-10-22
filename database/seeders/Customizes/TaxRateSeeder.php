<?php

namespace Database\Seeders\Customizes;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customizes\TaxRate;

class TaxRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        TaxRate::create(['tax_code'=>'S0103','start_date'=>'1989-04-01','end_date' => '1997-03-31','tax_rate'=>'3.00','normal_rate_flg'=>'1','text'=>'3%','created_by' => 'admin','changed_by' => 'admin',]);
        TaxRate::create(['tax_code'=>'S0205','start_date'=>'1997-04-01','end_date' => '2014-03-31','tax_rate'=>'5.00','normal_rate_flg'=>'1','text'=>'5%(国4%+地方1%)','created_by' => 'admin','changed_by' => 'admin',]);
        TaxRate::create(['tax_code'=>'S0308','start_date'=>'2014-04-01','end_date' => '2019-09-30','tax_rate'=>'8.00','normal_rate_flg'=>'1','text'=>'8%(国6.3%+地方1.7%)','created_by' => 'admin','changed_by' => 'admin',]);
        TaxRate::create(['tax_code'=>'S0408','start_date'=>'2019-10-01','end_date' => '9999-12-31','tax_rate'=>'8.00','normal_rate_flg'=>'0','text'=>'軽減税率8%(国6.24%+地方1.76%)','created_by' => 'admin','changed_by' => 'admin',]);
        TaxRate::create(['tax_code'=>'S0410','start_date'=>'2019-10-01','end_date' => '9999-12-31','tax_rate'=>'10.00','normal_rate_flg'=>'1','text'=>'標準税率10%(国7.8%+地方2.2%)','created_by' => 'admin','changed_by' => 'admin',]);
    }
}
