<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->foreignId("department_id")->nullable()->constrained('departments')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignUuid("teacher_id")->nullable()->constrained('teachers')->nullOnDelete()->cascadeOnUpdate();
            $table->text('description')->nullable();
            $table->integer('credits')->default(3);
            $table->boolean('is_active')->default(true);
            $table->unique(['code', 'department_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
