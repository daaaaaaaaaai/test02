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
            $table->double('quantity',11,3)->comment('数量');
            $table->char('unit',2)->comment('単位');
            $table->double('maker_price',9,2)->comment('小売価格');
            $table->double('unit_price',9,2)->comment('設定車体単価');
            $table->double('dlv_pre',9,2)->comment('納車準備費用');
            $table->double('dlv_price',9,2)->comment('配送費用');
            $table->double('remote_cost',9,2)->comment('遠方登録費用');
            $table->double('legal_fee_amount',9,2)->comment('法定費用合計');
            $table->double('starting_price',9,2)->comment('乗り出し価格');
            $table->double('ins_amnount',9,2)->comment('保険合計');
            $table->double('option_amount',9,2)->comment('付属品合計');
            $table->double('tradein_amount',9,2)->comment('下取車査定額');
            $table->doule('total_amount',13,2)->comment('合計金額');
            $table->double('cost_amount',9,2)->comment('原価合計')->nullable();

            // 法定費用
            $table->double('cali',9,2)->comment('自賠責保険料');
            $table->double('weight_tax',9,2)->comment('重量税');
            $table->double('reg_stamp',9,2)->comment('登録印紙代');
            $table->double('license_plate',9,2)->comment('ナンバー代');

            // 保険
            $table->double('suzuki_cp',9,2)->comment('スズキCP盗難保険2年');
            $table->double('road_srv',9,2)->comment('ロードサービス(SBSM)');
            $table->double('theft_ins',9,2)->comment('盗難保険(SBSM)');
            $table->double('zr_ext',9,2)->comment('延長保証(ZR)');
            $table->double('zr_moto',9,2)->comment('車両保証(ZR)');

            // 下取り
            $table->string('ti_model',60)->comment('車種')->nullable();
            $table->string('ti_color',60)->comment('色')->nullable();
            $table->integer('ti_years')->comment('年式')->nullable();
            $table->integer('ti_mileage')->comment('走行距離')->nullable();
            $table->string('ti_body_number',30)->comment('車体番号')->nullable();
            $table->char('ti_ins_value',2)->comment('保険加入有無')->nullable();
            $table->text('ti_remarks')->comment('下取備考')->nullable();

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
