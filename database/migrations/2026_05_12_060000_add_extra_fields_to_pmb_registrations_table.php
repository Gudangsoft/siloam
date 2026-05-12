<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pmb_registrations', function (Blueprint $table) {
            $table->string('citizenship', 100)->nullable()->default('WNI')->after('birth_place');
            $table->string('major', 100)->nullable()->after('high_school_name');
            $table->text('reason')->nullable()->after('study_program');
            $table->text('service_experience')->nullable()->after('reason');
        });
    }

    public function down(): void
    {
        Schema::table('pmb_registrations', function (Blueprint $table) {
            $table->dropColumn(['citizenship', 'major', 'reason', 'service_experience']);
        });
    }
};
