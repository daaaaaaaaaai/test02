<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales_expenses', function (Blueprint $table) {
            $table->date('start_date')->comment('開始日');
            $table->char('type',2)->comment('種別');
            $table->double('dlv_pre',9,2)->comment('納車準備費用')->nullable();
            $table->double('weight_tax',9,2)->comment('重量税')->nullable();
            $table->double('reg_stamp',9,2)->comment('登録印紙代')->nullable();
            $table->double('license_plate',9,2)->comment('ナンバー代')->nullable();
            $table->double('license_plate_cost',9,2)->comment('ナンバー原価')->nullable();
            $table->double('setup_cost',9,2)->comment('セットアップ')->nullable();
            $table->string('created_by',10)->comment('登録ユーザID');
            $table->string('changed_by',10)->comment('変更ユーザID');
            $table->timestamps();

            $table->comment('新車販売諸経費(乗りだし)');
            $table->primary(['start_date','type']);
            $table->unique(['start_date','type']);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_expenses');
    }
};
