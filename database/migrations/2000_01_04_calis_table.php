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
        Schema::create('calis', function (Blueprint $table) {
            $table->char('type',2)->comment('種別');
            $table->date('start_date')->comment('開始日');
            $table->double('month_00',9,2)->comment('加入なし')->nullable();
            $table->double('month_12',9,2)->comment('12ヶ月')->nullable();
            $table->double('month_24',9,2)->comment('24ヶ月')->nullable();
            $table->double('month_25',9,2)->comment('25ヶ月')->nullable();
            $table->double('month_36',9,2)->comment('36ヶ月')->nullable();
            $table->double('month_37',9,2)->comment('37ヶ月')->nullable();
            $table->double('month_48',9,2)->comment('48ヶ月')->nullable();
            $table->double('month_60',9,2)->comment('60ヶ月')->nullable();
            $table->double('month_99',9,2)->comment('車両入替')->nullable();
            $table->double('receipt_fee',9,2)->comment('受取手数料')->nullable();
            $table->string('created_by',10)->comment('登録ユーザID');
            $table->string('changed_by',10)->comment('変更ユーザID');
            $table->timestamps();

            $table->comment('自賠責保険');
            $table->primary(['type','start_date']);
            $table->unique(['type','start_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calis');
    }
};
