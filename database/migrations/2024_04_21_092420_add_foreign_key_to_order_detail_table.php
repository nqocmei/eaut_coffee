<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_detail', function (Blueprint $table) {
            $table->uuid('id_order')->change(); 
            $table->foreign(['id_order'], 'fk_order')
                ->references('id')
                ->on('order')
                ->onUpdate('restrict')
                ->onDelete('restrict');
            $table->foreign(['id_product'], 'fk_product_order')
                ->references('id')
                ->on('product')
                ->onUpdate('restrict')
                ->onDelete('restrict');
            $table->foreign(['id_user'], 'fk_user_order')
                ->references('id')
                ->on('user')
                ->onUpdate('restrict')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_detail', function (Blueprint $table) {
            $table->dropForeign(['fk_order']);
            $table->dropForeign(['fk_product_order']);
            $table->dropForeign(['fk_user_order']);
        });
    }
};
