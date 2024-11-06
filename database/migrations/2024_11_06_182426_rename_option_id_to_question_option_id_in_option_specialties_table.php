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
            $table->renameColumn('option_id', 'question_option_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('option_specialties', function (Blueprint $table) {
            $table->renameColumn('question_option_id', 'option_id');
        });
    }
};
