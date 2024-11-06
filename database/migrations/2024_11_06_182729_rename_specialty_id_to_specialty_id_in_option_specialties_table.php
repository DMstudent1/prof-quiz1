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
        Schema::table('option_specialties', function (Blueprint $table) {
            $table->renameColumn('specialties_id', 'specialty_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('option_specialties', function (Blueprint $table) {
            $table->renameColumn('specialty_id', 'specialties_id');
        });
    }
};
