<?php

namespace App\Helpers\Database;

use Illuminate\Database\Schema\Blueprint;

class MigrationHelper
{
    /**
     * Generates columns required for SEO
     *
     * @param Blueprint $table
     */
    public static function seoColumns(Blueprint $table)
    {
        $table->json('slug');
        $table->json('meta_title')->nullable();
        $table->json('meta_keywords')->nullable();
        $table->json('meta_description')->nullable();
        $table->text('schema')->nullable();
    }
}
