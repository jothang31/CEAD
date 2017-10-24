<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\CeadCountryDepartment;
use App\CeadMunicipality;
use App\CeadZoneType;
use App\CeadZoneLevel;

class RegionController extends Controller
{

    public function show () {

        return view('region');

    }

    public function newShow () {

        $countryDepartments = CeadCountryDepartment::all();
        $zoneLevels = CeadZoneLevel::all();
        $zoneTypes = CeadZoneType::all();

        // Solo los municipios del primer departamento
        $countryDepartmentCode = $countryDepartments->toArray()[0]['CCD_CODE'];
        $municipalities = CeadMunicipality::where('CCD_CODE', '=', $countryDepartmentCode)->get();

        return view('regionnew', compact(
            'countryDepartments', 
            'municipalities',
            'zoneLevels',
            'zoneTypes'
        ));

    }


    public function updateShow () {

        return 'Estamos trabajando';

    }
}
