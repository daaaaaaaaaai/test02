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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->char('material_code',40)->comment('商品コード')->nullable();
            $table->string('material_name',60)->comment('商品名');
            $table->string('model',40)->comment('機種名')->nullable();
            $table->char('color_code',5)->comment('色コード')->nullable();
            $table->string('color_name1')->comment('色名1')->nullable();
            $table->string('color_name2')->comment('色名2')->nullable();
            $table->string('body_number',30)->comment('車体番号')->nullable();
            $table->date('doc_date')->comment('伝票日付');
            $table->double('quantity',11,3)->comment('数量');
            $table->char('unit',5)->comment('数量単位')->nullable();
            $table->double('maker_price',9,2)->comment('小売価格')->nullable();
            $table->double('gross_price',9,2)->comment('仕切税抜')->nullable();
            $table->char('type_dlv',2)->comment('納準種別')->nullable();
            $table->char('type_cali',2)->comment('自賠責種別')->nullable();
            $table->char('type_theft',2)->comment('盗難種別')->nullable();
            $table->char('type_cr1_1',2)->comment('CR1種別①')->nullable();
            $table->char('type_cr1_2',2)->comment('CR1種別①')->nullable();
            $table->char('type_zr_ext',2)->comment('ZR延長種別')->nullable();
            $table->char('type_zr_moto',2)->comment('ZR車両種別')->nullable();
            $table->string('text_inv',255)->comment('在庫テキスト')->nullable();
            $table->text('remarks_inv')->comment('在庫備考')->nullable();
            $table->char('status_inv',1)->comment('在庫ステータス')->default('0');
            $table->char('mat_doc_no',10)->comment('入出庫伝票番号')->nullable();
            $table->char('item_number',5)->comment('入出庫伝票明細')->nullable();
            $table->string('created_by',10)->comment('登録ユーザID');
            $table->string('changed_by',10)->comment('変更ユーザID');
            $table->timestamps();
            $table->softDeletes();

            $table->comment('在庫データ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
