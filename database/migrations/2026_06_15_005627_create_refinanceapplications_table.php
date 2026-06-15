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
        Schema::create('refinanceapplications', function (Blueprint $table) {
            $table->id('RefinanceID');
            $table->foreignId('ContractID')->constrained('contracts', 'ContractID')->cascadeOnDelete();
            $table->date('ApplicationDate');
            $table->enum('status', ['Distributed', 'Pending', 'Approval'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refinanceapplications');
    }
};
