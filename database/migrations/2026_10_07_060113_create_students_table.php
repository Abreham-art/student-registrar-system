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

            $table->string('student_id', 30)->unique();

            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');

            $table->enum('gender', [
                'Male',
                'Female'
            ]);

            $table->date('date_of_birth')->nullable();

            $table->string('phone', 30)->nullable();
            $table->string('email')->nullable()->unique();

            $table->foreignId('department_id')
                ->constrained('departments')
                ->restrictOnDelete();

            $table->foreignId('program_id')
                ->constrained('programs')
                ->restrictOnDelete();

            $table->foreignId('academic_year_id')
                ->constrained('academic_years')
                ->restrictOnDelete();

            $table->string('admission_type', 30)
                ->default('Regular');

            $table->enum('status', [
                'Active',
                'Inactive',
                'Graduated',
                'Withdrawn'
            ])->default('Active');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};