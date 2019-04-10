<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Province;
use App\CityMunicipality;
use App\Barangay;

class LocationsController extends Controller
{
    public function province()
    {
        $provinces = Province::with(['cities_municipalities', 'cities_municipalities.barangays'])
                    ->orderBy('provDesc', 'asc')
                    ->get();

        return response()->json($provinces);
    }

    public function municipality($provCode)
    {
        $municipalities = CityMunicipality::where('provCode', $provCode)
                        ->orderBy('citymunDesc', 'asc')
                        ->get();

        return response()->json($municipalities);
    }

    public function barangay($citymunCode)
    {
        $barangays = Barangay::where('citymunCode', $citymunCode)
                    ->orderBy('brgyDesc', 'asc')
                    ->get();

        return response()->json($barangays);
    }
}
