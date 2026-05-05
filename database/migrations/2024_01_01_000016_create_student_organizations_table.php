<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_organizations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('abbreviation')->nullable();
            $table->string('type'); // BEM, UKM, HIMA
            $table->text('description')->nullable();
            $table->string('logo')->nullable();
            $table->string('chairman')->nullable(); // Ketua
            $table->string('advisor')->nullable(); // Pembimbing
            $table->string('email')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_organizations');
    }
};
