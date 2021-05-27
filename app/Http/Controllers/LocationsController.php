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
}
