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
        Schema::create('rebates', function (Blueprint $table) {
            $table->id('RebateID');
            $table->foreignId('RefinanceID')->constrained('refinanceapplications', 'RefinanceID')->cascadeOnDelete();
            $table->decimal('RemainingLoanInterest',10,2);
            $table->decimal('RemainingDeductInterest',10,2);
            $table->decimal('RemainingCapitaliseInterest',10,2);
            $table->decimal('TotalInterest',10,2);
            $table->decimal('RebatingInterestPercentage',10,2);
            $table->decimal('RebatingInterestAmount',10,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rebates');
    }
};
