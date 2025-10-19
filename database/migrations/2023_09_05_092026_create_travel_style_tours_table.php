<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTravelStyleToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travel_style_tours', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('travel_style_id');
            $table->foreign('travel_style_id')->on('travel_styles')
                ->references('id')->onDelete('CASCADE')->onUpdate('CASCADE');

            $table->unsignedBigInteger('tour_id');
            $table->foreign('tour_id')->on('tours')
                ->references('id')->onDelete('CASCADE')->onUpdate('CASCADE');

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
        Schema::dropIfExists('travel_style_tours');
    }
}
