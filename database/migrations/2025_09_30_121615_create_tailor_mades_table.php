<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTailorMadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tailor_mades', function (Blueprint $table) {
            $table->id();
            $table->string('time_option')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('month')->nullable();
            $table->string('days')->nullable();
            // full_name, email, phone_code, phone_number, nationality, hotel, adult, children, infant, price_range_min, price_range_max, notes, ( city => type json )
            $table->string('full_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_code')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('nationality')->nullable();
            $table->string('hotel')->nullable();
            $table->string('adult')->nullable();
            $table->string('children')->nullable();
            $table->string('infant')->nullable();
            $table->string('price_range_min')->nullable();
            $table->string('price_range_max')->nullable();
            $table->string('notes')->nullable();
            $table->json('city')->nullable();
            $table->integer('total')->default(0);
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
        Schema::dropIfExists('tailor_mades');
    }
}
