<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pmb_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number')->unique();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->string('gender'); // L/P
            $table->date('birth_date');
            $table->string('birth_place');
            $table->string('address');
            $table->string('city');
            $table->string('province');
            $table->string('high_school_name');
            $table->string('graduation_year');
            $table->string('study_program'); // program yang dipilih
            $table->string('registration_path')->nullable(); // jalur pendaftaran
            $table->string('parent_name');
            $table->string('parent_phone');
            $table->string('photo')->nullable();
            $table->string('ijazah_document')->nullable();
            $table->string('status')->default('pending'); // pending, review, accepted, rejected
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pmb_registrations');
    }
};
