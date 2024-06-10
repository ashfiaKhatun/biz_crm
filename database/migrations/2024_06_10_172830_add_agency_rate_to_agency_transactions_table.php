<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAgencyRateToAgencyTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agency_transactions', function (Blueprint $table) {
            $table->decimal('agency_rate', 8, 2)->nullable(); // Adjust the type and precision as needed
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agency_transactions', function (Blueprint $table) {
            $table->dropColumn('agency_rate');
        });
    }
}
