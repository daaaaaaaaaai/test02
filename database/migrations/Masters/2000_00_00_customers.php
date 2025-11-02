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
        Schema::create('customers', function (Blueprint $table) {
            $table->char('cust_code',10)->comment('顧客コード');
            $table->string('name_last',40)->comment('姓');
            $table->string('name_first',40)->nullable()->comment('名');
            $table->string('name_last_kana',40)->comment('姓(カナ)');
            $table->string('name_first_kana',40)->nullable()->comment('名(カナ)');
            $table->string('zipcode',20)->nullable()->comment('郵便番号');
            $table->char('prefecture',2)->nullable()->comment('都道府県');
            $table->string('city',100)->nullable()->comment('市区町村・番地')->nullable();
            $table->string('address',255)->nullable()->comment('建物名・部屋番号など')->nullable();
            $table->string('tel1',20)->nullable()->comment('電話番号1');
            $table->string('tel2',20)->nullable()->comment('電話番号2')->nullable();
            $table->string('email',40)->nullable()->comment('email');
            $table->boolean('line')->comment('LINE登録')->default("0");
            $table->string('created_by',10)->comment('登録ユーザID');
            $table->string('changed_by',10)->comment('変更ユーザID');
            $table->timestamps();

            $table->comment('顧客マスタ');
            $table->primary(['cust_code']);
            $table->unique(['cust_code']);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('customers');
    }
};