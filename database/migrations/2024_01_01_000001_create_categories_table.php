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
        if (Schema::hasTable('categories')) {
            return;
        }

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('is_active')->default(false);
            $table->string('slug');
            $table->string('catch_phrase')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
