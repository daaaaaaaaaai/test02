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
        //
        Schema::create('materials', function (Blueprint $table) {
            $table->char('material_code',40)->comment('商品コード');
            $table->string('material_name',60)->comment('商品名');
            $table->char('class_code',20)->commnt('分類');
            $table->string('model',40)->comment('機種名')->nullable();
            $table->string('color',40)->comment('カラー')->nullable();
            $table->integer('engine')->comment('排気量')->nullable();
            $table->char('coo',2)->comment('生産国')->nullable();
            $table->char('unit',5)->comment('数量単位')->nullable();
            $table->char('response_code',5)->comment('レス率コード')->nullable();
            $table->double('response_rate',5,2)->comment('レス率コード')->nullable();
            $table->double('unit_price',11,2)->comment('定価(税抜)');
            $table->double('unit_tax',11,2)->comment('定価(税額)');
            $table->double('unit_amount',13,2)->comment('定価(税込)');
            $table->double('sikr_price',11,2)->comment('仕切価格(税抜)')->nullable();
            $table->double('sikr_tax',11,2)->comment('仕切価格(税額)')->nullable();
            $table->double('sikr_amount',13,2)->comment('仕切価格(税込)')->nullable();
            $table->double('base_price',11,2)->comment('車体価格(税抜)')->nullable();
            $table->double('base_tax',11,2)->comment('車体価格(税額)')->nullable();
            $table->double('base_amount',13,2)->comment('車体価格(税込)')->nullable();
            $table->double('basic_margin',11,2)->comment('基本マージン')->nullable();
            $table->double('special_margin',11,2)->comment('特別マージン')->nullable();
            $table->double('cr1',11,2)->comment('CR①')->nullable();
            $table->double('cr2',11,2)->comment('CR②')->nullable();
            $table->double('r',11,2)->comment('R')->nullable();
            $table->char('tax_code',5)->comment('税コード')->nullable();
            $table->double('tax_rate',5,2)->comment('税率')->nullable();
            $table->string('text_material',255)->comment('商品テキスト')->nullable();
            $table->text('remarks_material')->comment('商品備考')->nullable();
            $table->string('created_by',10)->comment('登録ユーザID');
            $table->string('changed_by',10)->comment('変更ユーザID');
            $table->timestamps();
            $table->softDeletes();

            $table->comment('商品マスタ');
            $table->primary(['material_code']);
            $table->unique(['material_code']);
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
