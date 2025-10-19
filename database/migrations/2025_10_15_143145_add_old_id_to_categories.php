<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOldIdToCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            //
            $table->string('old_id')->nullable();
        });
        Schema::table('sub_categories', function (Blueprint $table) {
            //
            $table->string('old_id')->nullable();
        });
        Schema::table('tours', function (Blueprint $table) {
            //
            $table->string('old_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            //
        });
    }
}
