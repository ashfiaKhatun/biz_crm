<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToAdAccountsAndRefills extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ad_accounts', function (Blueprint $table) {
            $table->string('ad_acc_id')->nullable();
            $table->string('assign')->nullable();
        });

        Schema::table('refills', function (Blueprint $table) {
            $table->string('assign')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ad_accounts', function (Blueprint $table) {
            $table->dropColumn('ad_acc_id');
            $table->dropColumn('assign');
        });

        Schema::table('refills', function (Blueprint $table) {
            $table->dropColumn('assign');
        });
    }
}
