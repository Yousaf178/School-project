<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            // Personal Information
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');

            // Contact Information
            $table->string('email')->unique();
            $table->string('phone')->nullable();

            // Personal Details
            $table->date('date_of_birth')->nullable();
            $table->string('gender')->nullable();

            // Address
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();

            // Academic Information
            $table->string('student_id')->unique();
            $table->string('course')->nullable();
            $table->string('education')->nullable();

            // Admission
            $table->date('admission_date')->nullable();

            // Profile Image
            $table->string('profile_image')->nullable();
    // yousaf create a column for pdf file
    $table->string('student_pdf')->nullable();
    // end
            // Status
            $table->boolean('status')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};