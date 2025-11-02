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
        Schema::create('response_rates', function (Blueprint $table) {
            $table->char('response_code',5)->comment('レス率コード');
            $table->date('start_date')->comment('開始日');
            $table->date('end_date')->comment('終了日');
            $table->double('response_rate',5,2)->comment('レス率');
            $table->string('text',40)->comment('内容説明');
            $table->string('created_by',10)->comment('登録ユーザID');
            $table->string('changed_by',10)->comment('変更ユーザID');
            $table->timestamps();

            $table->comment('レス率');
            $table->primary(['response_code']);
            $table->unique(['response_code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('response_rates');
    }
};
