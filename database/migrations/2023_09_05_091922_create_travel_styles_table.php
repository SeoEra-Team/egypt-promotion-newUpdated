<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Helpers\Database\MigrationHelper;

class CreateTravelStylesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travel_styles', function (Blueprint $table) {
            $table->id();

            $table->json('name');
            $table->json('heading')->nullable();

            $table->json('short_description')->nullable();
            $table->json('description')->nullable();

            $table->boolean('status')->default(1);

            $table->integer('sort')->default(0);

            MigrationHelper::seoColumns($table);

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
        Schema::dropIfExists('travel_styles');
    }
}
