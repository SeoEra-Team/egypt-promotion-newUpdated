<?php

use App\Helpers\Database\MigrationHelper;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('sub_category_id');
            $table->foreign('sub_category_id')->on('sub_categories')
                ->references('id')->onDelete('CASCADE')->onUpdate('CASCADE');

            $table->json('name');
            $table->json('heading')->nullable();

            $table->enum('type', ['tour', 'package', 'nile-cruise']);

            $table->integer('price')->nullable();

            $table->json('short_description')->nullable();
            $table->json('overview')->nullable();

            $table->json('inclusion')->nullable();
            $table->json('exclusion')->nullable();
            $table->json('notes')->nullable();

            $table->json('pricing')->nullable();

            $table->json('duration')->nullable();
            $table->json('location')->nullable();
            $table->json('tour_availability')->nullable();
            $table->json('live_tour_guide')->nullable();

            $table->boolean('status')->default(1);
            $table->boolean('first')->default(0);
            $table->boolean('second')->default(0);
            $table->boolean('third')->default(0);
            
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
        Schema::dropIfExists('tours');
    }
}
