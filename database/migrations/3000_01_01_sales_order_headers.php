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
        Schema::create('salesorder_headers', function (Blueprint $table) {
            $table->char('order_number',10)->comment('受注伝票番号');
            $table->date('order_date')->comment('受注日');
            $table->char('cust_code',10)->comment('得意先コード');
            $table->string('staff_id',10)->comment('担当者コード');
            $table->char('tax_code',5)->comment('税コード');
            $table->double('gross_price',15,2)->comment('合計金額(税抜)');
            $table->double('gross_tax',13,2)->comment('税額');
            $table->double('gross_amount',15,2)->comment('合計金額(税込)');
            $table->string('text_header',255)->comment('ヘッダテキスト');
            $table->text('remarks_header')->comment('ヘッダ備考');
            $table->char('order_type',20)->comment('伝票種別');
            $table->char('order_status',1)->comment('伝票ステータス');
            $table->string('created_by',10)->comment('登録ユーザID');
            $table->string('changed_by',10)->comment('変更ユーザID');
            $table->timestamps();
            $table->softDeletes();

            $table->comment('受注伝票ヘッダ');
            $table->primary(['order_number']);
            $table->unique(['order_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('salesorder_headers');
    }
};
