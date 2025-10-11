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
        Schema::create('number_ranges', function (Blueprint $table) {
            $table->char('number_range',20)->comment('番号範囲オブジェクト');
            $table->string('number_from',20)->comment('開始番号');
            $table->string('number_to',20)->comment('終了番号');
            $table->string('number_current',20)->comment('現番号');
            $table->string('text',40)->comment('内容説明');
            $table->string('created_by',10)->comment('登録ユーザID');
            $table->string('changed_by',10)->comment('変更ユーザID');
            $table->timestamps();

            $table->comment('番号範囲');
            $table->primary(['number_range']);
            $table->unique(['number_range']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('number_ranges');
    }
};
