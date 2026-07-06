<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('articles')) {
            return;
        }

        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable();
            $table->longText('content')->nullable();
            $table->boolean('is_published')->default(false);
            $table->dateTime('published_at')->useCurrent();
            $table->text('catch_phrase')->nullable();
            $table->text('slug')->nullable();
            $table->foreignId('category_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
