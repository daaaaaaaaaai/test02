<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JapaneseCalendarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        \App\Models\JapaneseCalendar::create([
            'start_date' => '1868-01-25',
            'end_date' => '1912-07-30',
            'japanese_date' => '明治',
            'created_by' => 'admin',
            'changed_by' => 'admin',
        ]);
        \App\Models\JapaneseCalendar::create([
            'start_date' => '1912-07-30',
            'end_date' => '1926-12-25',
            'japanese_date' => '大正',
            'created_by' => 'admin',
            'changed_by' => 'admin',
        ]);
        \App\Models\JapaneseCalendar::create([
            'start_date' => '1926-12-25',
            'end_date' => '1989-01-08',
            'japanese_date' => '昭和',
            'created_by' => 'admin',
            'changed_by' => 'admin',
        ]);
        \App\Models\JapaneseCalendar::create([
            'start_date' => '1989-01-08',
            'end_date' => '2019-05-01',
            'japanese_date' => '平成',
            'created_by' => 'admin',
            'changed_by' => 'admin',
        ]);
        \App\Models\JapaneseCalendar::create([
            'start_date' => '2019-05-01',
            'end_date' => '9999-12-31',
            'japanese_date' => '令和',
            'created_by' => 'admin',
            'changed_by' => 'admin',
        ]);
    }
}
