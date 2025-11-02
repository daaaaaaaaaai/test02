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
        Schema::create('status_values', function (Blueprint $table) {
            $table->char('status',20)->comment('ステータス');
            $table->char('value',1)->comment('ステータス値');
            $table->string('text')->comment('内容説明');
            $table->string('created_by',10)->comment('登録ユーザID');
            $table->string('changed_by',10)->comment('変更ユーザID');
            $table->timestamps();

            $table->comment('ステータス');
            $table->primary(['status','value']);
            $table->unique(['status','value']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_values');
    }
};
