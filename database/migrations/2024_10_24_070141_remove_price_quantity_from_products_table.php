<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemovePriceQuantityFromProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['buying_price', 'price', 'quantity']);
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('buying_price', 10, 2)->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->integer('quantity')->default(0);
        });
    }
}
