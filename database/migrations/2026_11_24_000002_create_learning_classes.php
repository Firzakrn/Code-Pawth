<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('learning_classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained('users')->cascadeOnDelete();
            $table->string('name', 100);
            $table->string('level', 10)->default('Umum');
            $table->string('join_code', 7)->unique();
            $table->timestamps();
        });

        Schema::create('learning_class_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('learning_class_id')->constrained('learning_classes')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->unique(['learning_class_id', 'user_id']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('learning_class_user');
        Schema::dropIfExists('learning_classes');
    }
};
