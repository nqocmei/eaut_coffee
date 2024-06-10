<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name', 100)->nullable();
            $table->string('image_path')->nullable();
            $table->integer('price')->nullable();
            $table->text('description')->nullable();
            $table->integer('discount')->nullable();
            $table->integer('promotional_price')->nullable();
            $table->integer('amount')->nullable();
            $table->integer('id_category')->index('fk_customer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
};
