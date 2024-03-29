<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('biodatas', function (Blueprint $table) {
            $table->after('telp', function (Blueprint $table) {
                $table->string('pendidikan', 3);
                $table->char('gender', 1);
                $table->json('hobi');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('biodatas', function (Blueprint $table) {
            $table->dropColumn(['pendidikan', 'gender', 'hobi']);
        });
    }
};
