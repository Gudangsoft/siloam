<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('research', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('type'); // penelitian, pengabdian, hibah, publikasi, jurnal
            $table->text('abstract')->nullable();
            $table->string('researcher')->nullable();
            $table->string('year')->nullable();
            $table->string('funding_source')->nullable();
            $table->string('document')->nullable();
            $table->string('link')->nullable();
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('research');
    }
};
