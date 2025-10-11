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
        Schema::create('lisence_plate_costs', function (Blueprint $table) {
            $table->char('prefecture',02)->comment('都道府県');
            $table->string('pref_etc')->comment('その他');
            $table->double('purchase_price',11,2)->comment('仕入価格');
            $table->double('sales_price',11,2)->nullable()->comment('販売価格');
            $table->string('created_by',10)->comment('登録ユーザID');
            $table->string('changed_by',10)->comment('変更ユーザID');
            $table->timestamps();
            $table->softDeletes();

            $table->comment('ナンバープレート費用マスタ');
            $table->primary(['prefecture','pref_etc']);
            $table->unique(['prefecture','pref_etc']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lisence_plate_costs');
    }
};
