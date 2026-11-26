<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_level_progresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('class_code', 32);
            $table->string('jenjang', 3);
            $table->unsignedSmallInteger('level_id');
            $table->unsignedTinyInteger('score');
            $table->unsignedTinyInteger('stars');
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->unique(
                ['user_id', 'class_code', 'jenjang', 'level_id'],
                'student_level_progress_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_level_progresses');
    }
};
