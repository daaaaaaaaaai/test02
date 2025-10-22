<?php

namespace Database\Seeders\Masters;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Masters\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Customer::create([
            'cust_code' => 'sample',
            'name_last' => '井原',
            'name_first' => '大輔',
            'name_last_kana' => 'イハラ',
            'name_first_kana' => 'ダイスケ',
            'zipcode' => '5320001',
            'prefecture' => '27',
            'city' => '大阪市淀川区十八条',
            'address' => '1-1-32-509',
            'tel1' => '09046429563',
            'tel2' => '',
            'email' => 'ihadai15@yahoo.co.jp',
            'line' => '1',
            'created_by' => 'admin',
            'changed_by' => 'admin',
        ]);
    }
}
