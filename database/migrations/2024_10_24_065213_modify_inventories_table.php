<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyInventoriesTable extends Migration
{
    public function up()
    {
        Schema::table('inventories', function (Blueprint $table) {
            // Modify existing columns
            $table->decimal('buying_price', 10, 2)->nullable()->change(); // Make nullable
            $table->decimal('selling_price', 10, 2)->nullable()->change(); // Make nullable
            $table->integer('quantity')->default(0)->change(); // Ensure default is set
        });
    }

    public function down()
    {
        Schema::table('inventories', function (Blueprint $table) {
            // Revert changes to the original state
            $table->decimal('buying_price', 8, 2)->change(); // Change back to original
            $table->decimal('selling_price', 8, 2)->change(); // Change back to original
            $table->integer('quantity')->default(0)->change(); // Ensure default is reverted if necessary
        });
    }
}
