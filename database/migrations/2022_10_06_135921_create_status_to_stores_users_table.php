<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusToStoresUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
        });

        //MANY TO MANY
        Schema::table('stores_users', function(Blueprint $table)
        {
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade'); //
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stores_users', function (Blueprint $table) {
            //
        });
    }
}
