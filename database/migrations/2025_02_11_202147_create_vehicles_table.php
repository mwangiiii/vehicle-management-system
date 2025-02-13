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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('propulsion_id')->constrained('propulsions')->onDelete('cascade');
            $table->foreignId('make_id')->constrained('vehicle_makes')->onDelete('cascade');
            $table->foreignId('model_id')->constrained('vehicle_models')->onDelete('cascade');
            $table->string('colour');
            $table->string('numberplate')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
