<?php

namespace Database\Seeders\Masters;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Masters\Cali;

class CaliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Cali::create(['type'=>'01','start_date'=>'2025-04-01','month_00'=>'0','month_12'=>'6910','month_24'=>'8560','month_36'=>'10170','month_48'=>'11760','month_60'=>'13310','month_99'=>'3300','receipt_fee'=>'1733','created_by'=>'admin','changed_by'=>'admin',]);
        Cali::create(['type'=>'02','start_date'=>'2025-04-01','month_00'=>'0','month_12'=>'7100','month_24'=>'8920','month_36'=>'10710','month_48'=>'12470','month_60'=>'14200','month_99'=>'5000','receipt_fee'=>'1733','created_by'=>'admin','changed_by'=>'admin',]);
        Cali::create(['type'=>'03','start_date'=>'2025-04-01','month_24'=>'8760','month_25'=>'8910','month_37'=>'10630','receipt_fee'=>'1733','created_by'=>'admin','changed_by'=>'admin',]);
    }
}
