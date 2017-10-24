<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\CeadZone;

class ZoneController extends Controller
{
    public function get (Request $request) {

    	$code = $request->input('municipality');
    	$target = $request->input('target');

    	$zones = CeadZone::where('CM_CODE', '=', $code)->get(['CZ_CODE as code', 'CZ_NAME as name']);

    	return compact('zones', 'target');

    }

    public function save (Request $request) {

        $code = trim($request->zoneCode);
        $name = trim($request->zoneName);
        $municipality = $request->municipality;
        $zoneType = $request->zoneType;
        $zoneLevel = $request->zoneLevel;
        $target = $request->dataTarget;
        $form = $request->formId;

        $ceadZone = new CeadZone;

        $ceadZone->CZ_CODE = $code;
        $ceadZone->CZ_NAME = $name;
        $ceadZone->CM_CODE = $municipality;
        $ceadZone->CZT_CODE = $zoneType;
        $ceadZone->CZL_CODE = $zoneLevel;

        $ceadZone->save();

        return compact('form');
    }

    public function update (Request $request) {

    	
    	
    } 
}
