<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teacher_subjects', function (Blueprint $table) {
            $table->id();

            $table->foreignId('teacher_id')
                ->constrained('teachers')
                ->onDelete('cascade');

            $table->foreignId('subject_id')
                ->constrained('subjects')
                ->onDelete('cascade');

            $table->foreignId('class_id')
                ->constrained('school_classes')
                ->onDelete('cascade');

            $table->timestamps();

            $table->unique([
                'teacher_id',
                'subject_id',
                'class_id'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teacher_subjects');
    }
};