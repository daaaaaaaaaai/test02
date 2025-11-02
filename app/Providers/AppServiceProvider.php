<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;                // ページネーション
use Illuminate\Support\Facades\Schema;              // マイグレーション

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Paginator::useBootstrap();                  // ページネーション
        $this->loadMigrationsFrom([                 // マイグレーションファイルのパス追加
            database_path('migrations'),
            database_path('migrations/Customizes'),
            database_path('migrations/Defaults'),
            database_path('migrations/Masters'),
            database_path('migrations/Transactions'),
        ]);
    }
}
