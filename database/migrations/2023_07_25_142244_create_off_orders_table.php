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
        Schema::create('off_orders', function (Blueprint $table) {
            $table->id();

            $table->bigInteger("tab_id")->unsigned();
            $table->foreign('tab_id')->references('id')->on('tabs')->onDelete("cascade");
            $table->bigInteger("user_id")->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete("cascade");

            $table->float("total",10,2);
            $table->integer('discount')->nullable();
            $table->text('reason')->nullable();
            $table->tinyInteger("active")->unsigned()->default(1);





            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('off_orders');
    }
};
