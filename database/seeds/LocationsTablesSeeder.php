<?php

use Illuminate\Database\Seeder;

class LocationsTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('regions')->delete();
        $filepath = 'database/data/locations/refregion.json';
        $file = json_decode(file_get_contents($filepath,true))->RECORDS;

        foreach ($file as $key => $region) {
            App\Region::create((array)$region)->save();
        }

        DB::table('provinces')->delete();
        $filepath = 'database/data/locations/refprovince.json';
        $file = json_decode(file_get_contents($filepath,true))->RECORDS;

        foreach ($file as $key => $province) {
            App\Province::create((array)$province)->save();
        }

        DB::table('municipalities')->delete();
        $filepath = 'database/data/locations/refcitymun.json';
        $file = json_decode(file_get_contents($filepath,true))->RECORDS;

        foreach ($file as $key => $municipality) {
            App\Municipality::create((array)$municipality)->save();
        }

        DB::table('barangays')->delete();
        $filepath = 'database/data/locations/refbrgy.json';
        $file = json_decode(file_get_contents($filepath,true))->RECORDS;

        foreach ($file as $key => $barangay) {
            App\Barangay::create((array)$barangay)->save();
        }
    }
}
