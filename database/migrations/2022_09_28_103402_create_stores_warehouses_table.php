<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresWarehousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores_warehouses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
        //ONE TO MANY
        Schema::table('stores_warehouses', function(Blueprint $table)
        {
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade'); //
            $table->foreign('warehouse_id')->references('id')->on('warehouses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores_warehouses');
    }
}
