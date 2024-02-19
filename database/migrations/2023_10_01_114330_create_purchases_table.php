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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();


            $table->bigInteger("supplier_id")->unsigned();
            $table->foreign('supplier_id')->references('id')->on('suppliers');
            $table->bigInteger("user_id")->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->float("total",10,2);


            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
