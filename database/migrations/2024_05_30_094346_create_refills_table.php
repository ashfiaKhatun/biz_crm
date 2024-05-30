<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refills', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('ad_account_id');
            $table->decimal('amount_taka', 10, 2)->nullable();
            $table->decimal('amount_dollar', 10, 2)->nullable();
            $table->string('payment_method');
            $table->string('transaction_id');
            $table->string('screenshot')->nullable();
            $table->string('status')->default('pending'); // Add status column
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ad_account_id')->references('id')->on('ad_accounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('refills');
    }
}
