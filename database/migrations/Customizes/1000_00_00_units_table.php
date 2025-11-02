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
        Schema::create('units', function (Blueprint $table) {
            $table->char('unit',3)->comment('数量単位');
            $table->string('text',40)->comment('内容説明');
            $table->string('dimension',20)->comment('次元');
            $table->char('iso_code',3)->comment('ISOコード')->nullable();
            $table->integer('decimals')->comment('小数点桁数');
            $table->string('created_by',10)->comment('登録ユーザID');
            $table->string('changed_by',10)->comment('変更ユーザID');
            $table->timestamps();

            $table->comment('数量単位');
            $table->primary(['unit']);
            $table->unique(['unit']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
