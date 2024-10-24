<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('inventory_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity'); // Quantity added during this restock
            $table->decimal('buying_price', 10, 2); // Buying price during this restock
            $table->decimal('selling_price', 10, 2); // Selling price during this restock
            $table->timestamps();

            // Foreign key to link to the product
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventory_transactions');
    }
}
