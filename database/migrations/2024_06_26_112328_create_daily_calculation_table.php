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
        Schema::create('daily_calculations', function (Blueprint $table) {
            $table->id();
            $table->decimal('running_balance', 15, 2);
            $table->decimal('remaining_balance', 15, 2);
            $table->decimal('total_balance', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_calculation');
    }
};
