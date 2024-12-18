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
        Schema::create('option_specialties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('option_id')->constrained('question_options')->onDelete('cascade');
            $table->foreignId('specialties_id')->constrained('specialties')->onDelete('cascade');
            $table->unsignedTinyInteger('predisposition_level')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('option_specialties');
    }
};
