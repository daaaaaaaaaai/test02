<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// カスタマイズSeeder
use Database\Seeders\Customizes\ClassificationSeeder;
use Database\Seeders\Customizes\ColorSeeder;
use Database\Seeders\Customizes\CountrySeeder;
use Database\Seeders\Customizes\JapaneseCalendarSeeder;
use Database\Seeders\Customizes\MarginSeeder;
use Database\Seeders\Customizes\NumberRangeSeeder;
use Database\Seeders\Customizes\PrefectureSeeder;
use Database\Seeders\Customizes\RemoteCostSeeder;
use Database\Seeders\Customizes\ResponseRateSeeder;
use Database\Seeders\Customizes\TaxRateSeeder;
use Database\Seeders\Customizes\TypeSeeder;
use Database\Seeders\Customizes\TypeValueSeeder;
use Database\Seeders\Customizes\UnitSeeder;

// マスタSeeder
use Database\Seeders\Masters\CaliSeeder;
use Database\Seeders\Masters\CustomerSeeder;
use Database\Seeders\Masters\LisencePlateCostSeeder;
use Database\Seeders\Masters\MaterialSeeder;
use Database\Seeders\Masters\UserSeeder;

// トランザクションSeeder
use Database\Seeders\Transactions\SalesOrderSeeder;

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
            ColorSeeder::class,
            CountrySeeder::class,
            JapaneseCalendarSeeder::class,
            MarginSeeder::Class,
            NumberRangeSeeder::class,
            PrefectureSeeder::class,
            RemoteCostSeeder::Class,
            ResponseRateSeeder::class,
            TaxRateSeeder::class,
            TypeSeeder::Class,
            TypeValueSeeder::Class,
            UnitSeeder::class,

            CaliSeeder::class,
            CustomerSeeder::class,
            LisencePlateCostSeeder::class,
            MaterialSeeder::class,
            UserSeeder::class,

            SalesOrderSeeder::class,
        ]);
    }
}

