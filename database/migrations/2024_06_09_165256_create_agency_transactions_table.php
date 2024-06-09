<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgencyTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agency_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('refills_id')->constrained('refills')->onDelete('cascade');
            $table->decimal('cl_rate', 10, 2);
            $table->decimal('refill_usd', 10, 2);
            $table->decimal('refill_tk', 10, 2);
            $table->decimal('refill_act_usd', 10, 2)->nullable();
            $table->decimal('refill_act_tk', 10, 2)->nullable();
            $table->string('agency_charge_type')->nullable();
            $table->decimal('agency_charge', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agency_transactions');
    }
}
