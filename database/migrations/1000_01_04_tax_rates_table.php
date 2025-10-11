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
        Schema::create('tax_rates', function (Blueprint $table) {
            $table->char('tax_code',5)->comment('税コード');
            $table->date('start_date')->comment('開始日');
            $table->date('end_date')->comment('終了日');
            $table->double('tax_rate',5,2)->comment('税率');
            $table->boolean('normal_rate_flg')->comment('標準税率区分');
            $table->string('text',40)->comment('内容説明');
            $table->string('created_by',10)->comment('登録ユーザID');
            $table->string('changed_by',10)->comment('変更ユーザID');
            $table->timestamps();

            $table->comment('税率');
            $table->primary(['tax_code']);
            $table->unique(['tax_code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tax_rates');
    }
};
