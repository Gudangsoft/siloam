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
        Schema::table('staff', function (Blueprint $table) {
            $table->string('nuptk')->nullable()->after('nidn');
            $table->string('birth_place')->nullable()->after('nuptk');
            $table->date('birth_date')->nullable()->after('birth_place');
            $table->string('church')->nullable()->after('birth_date');
            $table->text('courses')->nullable()->after('expertise');
        });
    }

    public function down(): void
    {
        Schema::table('staff', function (Blueprint $table) {
            $table->dropColumn(['nuptk', 'birth_place', 'birth_date', 'church', 'courses']);
        });
    }
};
