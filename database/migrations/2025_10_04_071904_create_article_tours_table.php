<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_tours', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('article_id');
            $table->foreign('article_id')->on('articles')
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
        Schema::dropIfExists('article_tours');
    }
}
