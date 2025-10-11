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
        /*
        Schema::table('salesorder_headers', function (Blueprint $table) {
            //
            $table->foreign('cust_code')->references('cust_code')->on('customers')->OnDelete('cascade');
            $table->foreign('staff_id')->references('user_id')->on('users')->OnDelete('cascade');
        });
        Schema::table('salesorder_items', function (Blueprint $table) {
            //
            $table->foreign('order_number')->references('order_number')->on('salesorder_headers')->OnDelete('cascade');
            $table->foreign('material_code')->references('material_code')->on('materials')->OnDelete('cascade');
            $table->foreign('class_code')->references('class_code')->on('classifications')->OnDelete('cascade');
        });
        Schema::table('materials', function (Blueprint $table) {
            //
            $table->foreign('class_code')->references('class_code')->on('classifications')->OnDelete('cascade');
        });
        */
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        /*
        Schema::table('salesorder_headers', function (Blueprint $table) {
            //
            $table->dropForeign('salesorder_headers_cust_code_foreign');
            $table->dropForeign('salesorder_headers_staff_id_foreign');
        });
        Schema::table('salesorder_items', function (Blueprint $table) {
            //
            $table->dropForeign('salesorder_items_order_number_foreign');
            $table->dropForeign('salesorder_items_material_code_foreign');
            $table->dropForeign('salesorder_items_class_code_foreign');
        });
        Schema::table('materials', function (Blueprint $table) {
            //
            $table->dropForeign('materials_class_code_foreign');
        });
        */
    }
};
