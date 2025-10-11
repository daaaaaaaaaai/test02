<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalesOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        \App\Models\SalesOrderHeader::create([
            'order_number' => 'sample',
            'order_date' => '2025-10-09',
            'cust_code' => 'sample',
            'staff_id' => 'admin',
            'tax_code' => 'S0410',
            'gross_price' => '454073',
            'gross_tax' => '45407',
            'gross_amount' => '499480',
            'text_header' => 'text sample',
            'remarks_header' => 'remarks sample',
            'order_type' => 'SalesOrder',
            'order_status' => 'A',
            'created_by' => 'admin',
            'changed_by' => 'admin',
        ]);
        \App\Models\SalesOrderItem::create([
            'order_number' => 'sample',
            'item_number' => '00010',
            'material_code' => '000000000000000001',
            'material_name' => 'ジクサーＳＦ２５０ ABS  `20モデル',
            'quantity' => '1',
            'unit' => 'UN',
            'unit_price' => '481800',
            'net_price' => '499480',
            'class_code' => '001001',
            'text_item' => 'text sample',
            'remarks_item' => 'remarks sample',
            'created_by' => 'admin',
            'changed_by' => 'admin',
        ]);
    }
}
