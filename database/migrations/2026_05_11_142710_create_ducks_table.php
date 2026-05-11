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
        Schema::create('ducks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('age'); // in weeks or days, specify in model
            $table->string('breed')->nullable();
            $table->date('hatch_date');
            $table->enum('status', ['active', 'sold', 'deceased'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ducks');
    }
};
