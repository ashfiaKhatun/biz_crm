<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->string('ad_acc_name');
            $table->string('bm_id');
            $table->string('fb_link1')->nullable();
            $table->string('fb_link2')->nullable();
            $table->string('fb_link3')->nullable();
            $table->string('fb_link4')->nullable();
            $table->string('fb_link5')->nullable();
            $table->string('domain1')->nullable();
            $table->string('domain2')->nullable();
            $table->string('domain3')->nullable();
            $table->unsignedBigInteger('agency_id');
            $table->string('ad_acc_type');
            $table->decimal('dollar_rate', 8, 2);
            $table->string('status')->default('pending');
            $table->timestamps();

            // Define foreign keys
            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('agency_id')->references('id')->on('agencies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ad_accounts');
    }
}
