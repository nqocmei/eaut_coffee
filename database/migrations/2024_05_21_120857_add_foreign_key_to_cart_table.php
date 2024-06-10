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
        Schema::table('cart', function (Blueprint $table) {
            $table->foreign(['id_product'], 'fk_cart_product')->references(['id'])->on('product')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['id_user'], 'fk_cart_user')->references(['id'])->on('user')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cart', function (Blueprint $table) {
            $table->dropForeign('fk_cart_product');
            $table->dropForeign('fk_cart_user');
        });
    }
};
