<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')
                ->constrained('students')
                ->onDelete('cascade');

            $table->foreignId('class_id')
                ->constrained('school_classes')
                ->onDelete('cascade');

            $table->foreignId('academic_year_id')
                ->constrained('academic_years')
                ->onDelete('cascade');

            $table->date('enrollment_date')->nullable();

            $table->string('status')->default('active');

            $table->timestamps();

            $table->unique(['student_id', 'academic_year_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};