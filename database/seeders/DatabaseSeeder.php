<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /*
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        */
        
        // 実行順序を制御可能
        $this->call([
            ClassificationSeeder::class,
            JapaneseCalendarSeeder::class,
            NumberRangeSeeder::class,
            TaxRateSeeder::class,
            UserSeeder::class,
            CountrySeeder::class,
            UnitSeeder::class,
            ResponseRateSeeder::class,
            PrefectureSeeder::class,
            ColorSeeder::class,
            MarginSeeder::Class,
            RemoteCostSeeder::Class,
            TypeSeeder::Class,
            TypeValueSeeder::Class,

            MaterialSeeder::class,
            CustomerSeeder::class,
            LisencePlateCostSeeder::class,
            CaliSeeder::class,

            SalesOrderSeeder::class,
        ]);
    }
}

