<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('user_id'); // Foreign key to the users table
            $table->string('user_name'); // Store user name (optional)
            $table->string('status')->default('pending'); // Order status (e.g., pending, completed, canceled)
            $table->decimal('total_amount', 10, 2); // Total price of the order
            $table->unsignedBigInteger('address_id'); // Foreign key to the address table
            $table->timestamps(); // Created_at and updated_at fields

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
