<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('article_category', function (Blueprint $table) {
            $table->foreignId('article_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->primary(['article_id', 'category_id']);
        });

        DB::table('article_category')->insertUsing(
            ['article_id', 'category_id'],
            DB::table('articles')
                ->select(['articles.id', 'articles.category_id'])
                ->join('categories', 'categories.id', '=', 'articles.category_id')
        );
    }
};
