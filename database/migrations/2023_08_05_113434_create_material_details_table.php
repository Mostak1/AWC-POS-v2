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
        Schema::create('material_details', function (Blueprint $table) {
            $table->id();

            $table->bigInteger("menu_id")->unsigned();
            $table->foreign('menu_id')->references('id')->on('menus');


            $table->bigInteger("material_id")->unsigned();
            $table->foreign('material_id')->references('id')->on('materials');

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
        Schema::dropIfExists('material_details');
    }
};
