<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_offerings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('course_id')
                ->constrained('courses')
                ->restrictOnDelete();

            $table->foreignId('semester_id')
                ->constrained('semesters')
                ->restrictOnDelete();

            $table->string('instructor_name')->nullable();

            $table->unsignedSmallInteger('capacity')->default(50);

            $table->string('room')->nullable();

            $table->string('schedule')->nullable();

            $table->boolean('status')->default(true);

            $table->timestamps();

            $table->unique([
                'course_id',
                'semester_id'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_offerings');
    }
};