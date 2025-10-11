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
        Schema::create('countries', function (Blueprint $table) {
            $table->char('country_code',2)->comment('国コード(alpha-2)');
            $table->string('country_name_j',80)->comment('国名(日本語)');
            $table->string('country_name_e',80)->comment('国名(英語)');
            $table->char('country_code_a3',3)->comment('国コード(alpha-3)');
            $table->char('country_code_n3',3)->comment('国コード(numeric-3');
            $table->string('created_by',10)->comment('登録ユーザID');
            $table->string('changed_by',10)->comment('変更ユーザID');
            $table->timestamps();

            $table->comment('国');
            $table->primary(['country_code']);
            $table->unique(['country_code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
