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
        Schema::create('types', function (Blueprint $table) {
            $table->char('type',2)->comment('種別');
            $table->string('text')->comment('種別名');
            $table->string('created_by',10)->comment('登録ユーザID');
            $table->string('changed_by',10)->comment('変更ユーザID');
            $table->timestamps();

            $table->comment('種別');
            $table->primary(['type']);
            $table->unique(['type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('types');
    }
};
