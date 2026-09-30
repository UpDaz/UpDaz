<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('weekly_digests', function (Blueprint $table) {
            $table->string('status')->default('proposed')->after('summary');
            $table->string('topic_title')->nullable()->after('theme');
            $table->foreignId('overlapping_article_id')->nullable()->after('post_id')->constrained('articles')->nullOnDelete();
            $table->json('interview_questions')->nullable()->after('status');
            $table->json('interview_answers')->nullable()->after('interview_questions');
            $table->longText('proposed_update')->nullable()->after('interview_answers');
            $table->text('proposed_update_summary')->nullable()->after('proposed_update');
            $table->timestamp('proposed_at')->nullable();
            $table->timestamp('interview_sent_at')->nullable();
            $table->timestamp('reminded_at')->nullable();
        });
    }
};
