<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraFieldsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->nullable()->after('name');
            $table->string('phone')->nullable()->after('username');
            $table->string('business_type')->nullable()->after('phone');
            $table->string('business_name')->nullable()->after('business_type');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
            $table->dropColumn('phone');
            $table->dropColumn('business_type');
            $table->dropColumn('business_name');
        });
    }
}
