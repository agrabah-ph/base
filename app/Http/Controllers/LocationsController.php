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
        return response([

            'provinces' => Province::with(['cities_municipalities', 'cities_municipalities.barangays'])
            ->orderBy('provDesc', 'asc')
            ->get()

        ]);
    }

    public function municipality($provCode)
    {
        return response([

            'municipalities' => CityMunicipality::where('provCode', $provCode)->get()

        ]);
    }
    public function barangay($citymunCode)
    {
        return response([
            'barangays' => Barangay::
                where('citymunCode', $citymunCode)
                ->orderBy('brgyDesc', 'asc')
                ->get()
        ]);
    }
}
