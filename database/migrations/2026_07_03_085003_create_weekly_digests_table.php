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
        Schema::create('weekly_digests', function (Blueprint $table) {
            $table->id();
            $table->date('week_start');
            $table->string('theme');
            $table->text('summary');
            $table->json('raw_article_ids');
            $table->foreignId('post_id')->nullable()->constrained('articles');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weekly_digests');
    }
};
