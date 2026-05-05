<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('url')->nullable();
            $table->string('icon')->nullable();           // FontAwesome class, e.g. "fas fa-home"
            $table->unsignedBigInteger('parent_id')->nullable(); // null = top-level
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->string('target')->default('_self');  // _self | _blank
            $table->string('location')->default('main'); // main | footer
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('menus')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
