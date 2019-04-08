<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvincesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provinces', function (Blueprint $table) {
          $table->increments('id');
          $table->string('psgcCode', 100);
          $table->string('provDesc', 100);
          $table->string('regCode',10);
          $table->string('provCode', 10)->unique();
      });

      $filepath = storage_path() . '/addresses/refprovince.json';
      $file = json_decode(file_get_contents($filepath,true))->RECORDS;

      foreach ($file as $key => $province) {
        App\Province::create((array)$province)->save();
      }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('provinces');
    }
}
