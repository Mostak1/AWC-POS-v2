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
        Schema::create('purchase_details', function (Blueprint $table) {
            $table->id();


            $table->bigInteger("purchase_id")->unsigned();
            $table->foreign('purchase_id')->references('id')->on('purchases')->onDelete("cascade");

            $table->bigInteger("material_id")->unsigned();
            $table->foreign('material_id')->references('id')->on('materials')->onDelete("cascade");

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
        Schema::dropIfExists('purchase_details');
    }
};
