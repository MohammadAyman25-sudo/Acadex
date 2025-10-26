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
            $table->enum('role', ['Instructor', 'Assistant'])->default('Instructor')->after('teacher_id');
            $table->enum('semester', ['Fall', 'Spring', 'Summer'])->nullable()->after('role');
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
