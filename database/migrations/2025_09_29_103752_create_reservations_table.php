<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tour_id');
            $table->foreign('tour_id')->on('tours')->references('id')
                ->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('code')->nullable();
            $table->string('phone_number')->nullable();
            $table->timestamp('date')->nullable();
            $table->integer('total')->default(0);
            $table->tinyInteger('adults')->default(1);
            $table->tinyInteger('children')->default(0);
            $table->tinyInteger('infants')->default(0);
            $table->text('message')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('reservations');
    }
}
