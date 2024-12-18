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
        Schema::create('Forecasts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('city_id');
            $table->integer('temperature');
            $table->dateTime('forecasted_at');
            $table->timestamps();

            // Povezivanje sa tabelom 'cities'
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
