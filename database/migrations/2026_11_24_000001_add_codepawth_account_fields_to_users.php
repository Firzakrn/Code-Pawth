<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Periksa agar tidak membuat kolom ganda bila proyek memakai database lama.
        if (!Schema::hasColumn('users', 'role')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('role', 20)->default('murid');
            });
        }
        if (!Schema::hasColumn('users', 'phone')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('phone', 20)->nullable();
            });
        }
        if (!Schema::hasColumn('users', 'school')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('school')->nullable();
            });
        }
    }

    public function down(): void
    {
        // Tidak menghapus kolom pada rollback: kolom mungkin sudah ada
        // dan berisi data sebelum migration ini dijalankan.
    }
};
