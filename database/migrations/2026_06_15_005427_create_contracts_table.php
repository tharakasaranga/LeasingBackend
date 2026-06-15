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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id('ContractID');
            $table->foreignId('CustomerID')->constrained('customers', 'CustomerID')->cascadeOnDelete();
            $table->foreignId('VehicleID')->constrained('vehicles', 'VehicleID')->cascadeOnDelete();
            $table->decimal('LoanAmount',10,2);
            $table->decimal('LeasingAmount',10,2);
            $table->enum('status', ['Distributed', 'Pending', 'Approval'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
