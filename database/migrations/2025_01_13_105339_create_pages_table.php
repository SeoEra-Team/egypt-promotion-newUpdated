<?php

use App\Helpers\Database\MigrationHelper;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->json('heading');
            $table->json('sub_heading')->nullable();
            $table->json('content')->nullable();
            $table->json('title')->nullable();
            $table->json('description')->nullable(); 
            $table->boolean('show_in_header')->default(0);
            $table->boolean('show_in_footer')->default(0);
            $table->boolean('status')->default(1);
            $table->string('type')->nullable();
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
        Schema::dropIfExists('pages');
    }
}
