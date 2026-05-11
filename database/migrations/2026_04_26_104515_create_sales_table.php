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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('total_trays');
            $table->unsignedInteger('total_eggs_sold');
            $table->decimal('selling_price', 10, 2);
            $table->decimal('gross_income', 12, 2);
            $table->decimal('total_expenses', 12, 2)->default(0);
            $table->decimal('net_income', 12, 2);
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->text('notes')->nullable();
            $table->date('month_of');
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
