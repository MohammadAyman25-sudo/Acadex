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
        Schema::table('course_teacher', function (Blueprint $table) {
            $table->enum('role', ['primary_instructor', 'assistant_instructor', 'guest_lecturer'])->default('primary_instructor')->after('teacher_id');
            $table->string('semester')->nullable()->after('role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course_teacher', function (Blueprint $table) {
            //
        });
    }
};
