<?php

use App\Helpers\Database\MigrationHelper;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->json('heading')->nullable();
            $table->json('menu_title')->nullable();

            $table->json('short_description')->nullable();
            $table->json('description')->nullable();

            $table->boolean('status')->default(1);
            $table->boolean('footer')->default(0);
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('categories');
        Schema::enableForeignKeyConstraints();
    }
}
