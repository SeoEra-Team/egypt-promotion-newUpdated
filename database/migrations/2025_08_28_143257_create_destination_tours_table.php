<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDestinationToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('destination_tours', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('destination_id');
            $table->foreign('destination_id')->on('destinations')
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
        Schema::dropIfExists('destination_tours');
    }
}
