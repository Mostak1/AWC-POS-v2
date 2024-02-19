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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();

            
            $table->bigInteger("order_id")->unsigned();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete("cascade");

            $table->bigInteger("menu_id")->unsigned();
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete("cascade");

            $table->integer("quantity")->unsigned();


            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
