<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangays', function (Blueprint $table) {
            $table->increments('id');
            $table->string('brgyCode',10)->unique();
            $table->string('brgyDesc', 100);
            $table->string('regCode',10);
            $table->string('provCode',10)->default("");
            $table->string('citymunCode',10)->default("");
            $table->foreign('provCode')->references('provCode')->on('provinces')->onDelete('cascade');
            $table->foreign('citymunCode')->references('citymunCode')->on('cities_municipalities')->onDelete('cascade');
        });

        // $filepath = storage_path() . '/addresses/refbrgy.json';
        // $file = json_decode(file_get_contents($filepath,true))->RECORDS;

        // foreach ($file as $key => $barangay)
        // {
        //     App\Barangay::create((array)$barangay)->save();
        // }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('barangays');
    }
}
