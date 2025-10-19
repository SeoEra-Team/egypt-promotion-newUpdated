<?php

use App\Helpers\Database\MigrationHelper;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->on('categories')
                ->references('id')->onUpdate('CASCADE')->onDelete('CASCADE');

            $table->json('name');
            $table->json('heading')->nullable();

            $table->json('short_description')->nullable();
            $table->json('description')->nullable();

            $table->boolean('status')->default(1);
            
            $table->boolean('first')->default(0);
            $table->boolean('second')->default(0);
            $table->boolean('header')->default(0);

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
        Schema::dropIfExists('sub_categories');
    }
}
