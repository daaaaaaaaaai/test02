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
        Schema::create('materials', function (Blueprint $table) {
            $table->char('material_code',40)->comment('商品コード');
            $table->string('material_name',60)->comment('商品名');
            $table->char('class_code',20)->commnt('分類');
            $table->string('model',40)->comment('機種名')->nullable();
            $table->integer('engine')->comment('排気量')->nullable();
            $table->char('coo',2)->comment('生産国')->nullable();
            $table->char('unit',5)->comment('数量単位')->nullable();
            $table->char('type_dlv',2)->comment('納準種別')->nullable();
            $table->char('type_cali',2)->comment('自賠責種別')->nullable();
            $table->char('type_theft',2)->comment('盗難種別')->nullable();
            $table->char('type_cr1_1',2)->comment('CR1種別①')->nullable();
            $table->char('type_cr1_2',2)->comment('CR1種別②')->nullable();
            $table->char('type_zr_ex',2)->comment('ZR延長種別')->nullable();
            $table->char('type_zr_moto',2)->comment('ZR車両種別')->nullable();
            $table->char('color_code01',5)->comment('色コード1')->nullable();
            $table->char('color_code02',5)->comment('色コード2')->nullable();
            $table->char('color_code03',5)->comment('色コード3')->nullable();
            $table->char('color_code04',5)->comment('色コード4')->nullable();
            $table->char('color_code05',5)->comment('色コード5')->nullable();
            $table->string('color_name01',40)->comment('色名1')->nullable();
            $table->string('color_name02',40)->comment('色名2')->nullable();
            $table->string('color_name03',40)->comment('色名3')->nullable();
            $table->string('color_name04',40)->comment('色名4')->nullable();
            $table->string('color_name05',40)->comment('色名5')->nullable();
            $table->string('text_material',255)->comment('商品テキスト')->nullable();
            $table->text('remarks_material')->comment('商品備考')->nullable();
            $table->string('created_by',10)->comment('登録ユーザID');
            $table->string('changed_by',10)->comment('変更ユーザID');
            $table->timestamps();

            $table->comment('商品マスタ');
            $table->primary(['material_code']);
            $table->unique(['material_code']);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('materials');
    }
};