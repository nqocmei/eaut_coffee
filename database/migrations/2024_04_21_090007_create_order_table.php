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
        Schema::create('order', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('recipient');
            $table->dateTime('order_date')->nullable()->useCurrent();
            $table->dateTime('delivery_date')->nullable()->useCurrent();
            $table->integer('total_funds')->default(0);
            $table->tinyInteger('payment_methods')->default(0);
            $table->string('delivery_address', 1000);
            $table->integer('status')->nullable();
            $table->string('pickup_phone');
            $table->integer('id_user');
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
        Schema::dropIfExists('order');
    }
}
;
