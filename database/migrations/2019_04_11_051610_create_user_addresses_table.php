<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_addresses', function (Blueprint $table) {

            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('provCode');
            $table->string('citymunCode');
            $table->string('brgyCode');
            $table->string('address_line');
            $table->string('lat');
            $table->string('lng');
            $table->timestamps();

            $table->foreign('provCode')
                ->references('provCode')
                ->on('provinces')
                ->onDelete('cascade');

            $table->foreign('citymunCode')
                ->references('citymunCode')
                ->on('cities_municipalities')
                ->onDelete('cascade');

            $table->foreign('brgyCode')
                ->references('brgyCode')
                ->on('barangays')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_addresses');
    }
}
