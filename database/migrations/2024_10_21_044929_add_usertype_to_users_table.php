<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUsertypeToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Add a new 'usertype' column to identify admin and customer
            $table->string('usertype')->default('customer')->after('password');
            // You can also use enum type if you want predefined values for admin/customer
            // $table->enum('usertype', ['admin', 'customer'])->default('customer')->after('password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the 'usertype' column when rolling back the migration
            $table->dropColumn('usertype');
        });
    }
}
