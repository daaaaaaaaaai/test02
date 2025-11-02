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
        Schema::create('material_document_headers', function (Blueprint $table) {
            $table->char('mat_doc_no',10)->comment('入出庫伝票番号');
            $table->date('doc_date')->comment('伝票日付');
            $table->string('text_header',255)->comment('ヘッダテキスト');
            $table->text('remarks_header')->comment('ヘッダ備考');
            $table->char('order_type',20)->comment('伝票種別');
            $table->char('doc_type',20)->comment('伝票種別');
            $table->char('doc_status',1)->comment('伝票ステータス');
            $table->string('created_by',10)->comment('登録ユーザID');
            $table->string('changed_by',10)->comment('変更ユーザID');
            $table->timestamps();
            $table->softDeletes();

            $table->comment('入出庫伝票ヘッダ');
            $table->primary(['mat_doc_no']);
            $table->unique(['mat_doc_no']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_document_headers');
    }
};
