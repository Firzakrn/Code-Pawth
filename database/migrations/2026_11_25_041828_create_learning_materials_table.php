<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('learning_materials', function (Blueprint $table) {
            $table->id();

            $table->foreignId('teacher_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('learning_class_id')
                ->nullable()
                ->constrained('learning_classes')
                ->nullOnDelete();

            $table->string('title');
            $table->string('type', 30);
            $table->string('level', 10);
            $table->string('status', 20)->default('draft');
            $table->json('content');

            $table->timestamps();

            $table->index(['teacher_id', 'type']);
            $table->index(['learning_class_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('learning_materials');
    }
};