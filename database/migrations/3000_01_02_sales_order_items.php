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
        Schema::create('salesorder_items', function (Blueprint $table) {
            $table->char('order_number',10)->comment('受注伝票番号');
            $table->char('item_number',5)->comment('受注伝票明細');
            $table->string('material_code',40)->comment('商品コード');
            $table->string('material_name',60)->comment('商品名');
            $table->string('color',60)->comment('カラー');
            $table->string('model',60)->comment('モデル');
            $table->double('price_make',11,2)->comment('単価');
            $table->double('net_price',13,2)->comment('金額');
            $table->string('class_code',20)->comment('分類');
            $table->string('text_item',255)->comment('明細テキスト');
            $table->text('remarks_item')->comment('明細備考');
            $table->string('created_by',10)->comment('登録ユーザID');
            $table->string('changed_by',10)->comment('変更ユーザID');
            $table->timestamps();
            $table->softDeletes();

            $table->comment('受注伝票明細');
            $table->primary(['order_number','item_number']);
            $table->unique(['order_number','item_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('salesorder_items');
    }
};
