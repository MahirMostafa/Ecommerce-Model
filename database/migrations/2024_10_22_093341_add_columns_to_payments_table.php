<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->foreignId('order_id')->constrained()->onDelete('cascade'); // Reference to the order
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // Reference to the user
            $table->decimal('amount', 10, 2);  // Payment amount
            $table->string('method')->default('COD');  // Payment method (COD or Online)
            $table->string('status')->default('pending');  // Status: pending, paid, failed, etc.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            //
        });
    }
};
