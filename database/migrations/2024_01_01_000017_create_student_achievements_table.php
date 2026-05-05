<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_achievements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('student_name');
            $table->string('study_program')->nullable();
            $table->string('level'); // internasional, nasional, regional, lokal
            $table->string('award')->nullable(); // juara 1, 2, 3, dll
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->integer('year');
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_achievements');
    }
};
