<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Execução da Migration
     * Tabela Users, adição da coluna Picture
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('picture')->nullable()->after('email_verified_at');
        });
    }

    /**
     * Rollback da Migration
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('picture');
        });
    }
};
