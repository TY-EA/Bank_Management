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
        Schema::create('virements', function (Blueprint $table) {
            $table->id();
            $table->string('rib_source'); // RIB du compte source
            $table->string('rib_target'); // RIB du compte destination
            $table->decimal('montant', 12, 2);
            $table->dateTime('date_virement')->useCurrent(); // Auto-set to current date
            $table->string('description')->nullable();
            $table->enum('statut', ['completed', 'pending', 'failed'])->default('completed');
            $table->timestamps();

            // Indices for faster queries
            $table->index('rib_source');
            $table->index('rib_target');
            $table->index('date_virement');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('virements');
    }
};
