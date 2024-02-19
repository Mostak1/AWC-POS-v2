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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();

            $table->bigInteger("user_id")->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->bigInteger("mealperiod_id")->unsigned();
            $table->foreign('mealperiod_id')->references('id')->on('mealperiods');

            $table->bigInteger("status_id")->unsigned();
            $table->foreign('status_id')->references('id')->on('statuses');

            $table->integer("person")->unsigned();
            $table->date('date')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
