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
        Schema::create('suzuki_data', function (Blueprint $table) {
            $table->date('start_date')->comment('開始日');
            $table->char('type',2)->comment('種別');
            $table->char('material_code',40)->comment('商品コード');
            $table->string('material_name',60)->comment('商品名');
            $table->double('maker_price',9,2)->comment('小売価格')->nullable();
            $table->double('response_rate',5,2)->comment('レス率')->nullable();
            $table->double('basic_margin',9,2)->comment('基本マージン')->nullable();
            $table->double('special_margin',9,2)->comment('特別マージン')->nullable();
            $table->double('gross_price',9,2)->comment('仕切税抜')->nullable();
            $table->double('gross_amount',9,2)->comment('仕切税込')->nullable();
            $table->double('unit_price',9,2)->comment('設定車体単価')->nullable();
            $table->double('dlv_pre',9,2)->comment('納車準備費用')->nullable();
            $table->double('weight_tax',9,2)->comment('重量税')->nullable();
            $table->double('reg_stamp',9,2)->comment('登録印紙代')->nullable();
            $table->double('license_plate',9,2)->comment('ナンバー代')->nullable();
            $table->double('cali',9,2)->comment('自賠責保険料')->nullable();
            $table->double('starting_price',9,2)->comment('乗り出し価格')->nullable();
            $table->double('profit',9,2)->comment('利益額')->nullable();
            $table->double('profit_rate',5,2)->comment('利益率')->nullable();
            $table->double('moto_cost_incl_tax',9,2)->comment('税込車両原価')->nullable();
            $table->double('int_weight_tax',9,2)->comment('重量税')->nullable();
            $table->double('int_reg_stamp',9,2)->comment('登録印紙代')->nullable();
            $table->double('int_license_plate',9,2)->comment('ナンバー代')->nullable();
            $table->double('int_cali',9,2)->comment('自賠責保険料')->nullable();
            $table->double('cost_amount',9,2)->comment('原価合計')->nullable();
            $table->char('type_dlv',2)->comment('納準種別')->nullable();
            $table->char('type_cali',2)->comment('自賠責種別')->nullable();
            $table->char('type_theft',2)->comment('盗難種別')->nullable();
            $table->char('type_cr1_1',2)->comment('CR1種別①')->nullable();
            $table->char('type_cr1_2',2)->comment('CR1種別①')->nullable();
            $table->char('type_zr_ext',2)->comment('ZR延長種別')->nullable();
            $table->char('type_zr_moto',2)->comment('ZR車両種別')->nullable();
            $table->char('type_store',2)->comment('店内状態')->nullable();
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
            $table->char('response_code',5)->comment('レス率コード')->nullable();
            $table->char('tax_code',5)->comment('税コード')->nullable();
            $table->string('created_by',10)->comment('登録ユーザID');
            $table->string('changed_by',10)->comment('変更ユーザID');
            $table->timestamps();

            $table->comment('スズキ車両標準データ');
            $table->primary(['start_date','type','material_code']);
            $table->unique(['start_date','type','material_code']);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suzuki_data');
    }
};
