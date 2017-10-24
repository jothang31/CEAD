<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\CeadMunicipality;

class MunicipalityController extends Controller
{
    public function get(Request $request) {

    	$code = $request->input('department');
    	$target = $request->input('target');

    	$municipalities = CeadMunicipality::where('CCD_CODE', '=', $code)->get(['CM_CODE as code', 'CM_NAME as name']);

    	return compact('municipalities', 'target');

    }

    public function save (Request $request) {

        $code = trim($request->municipalityCode);
        $name = trim($request->municipalityName);
        $countryDepartment = $request->countryDepartment;
        $targetCountryDepartment = $request->dataTargetContryDepartment;
        $target = $request->dataTarget;
        $form = $request->formId;

        $ceadMunicipality = new CeadMunicipality;

        $ceadMunicipality->CM_CODE = $code;
        $ceadMunicipality->CM_NAME = $name;
        $ceadMunicipality->CCD_CODE = $countryDepartment;

        $ceadMunicipality->save();

        return compact(
            'code',
            'name',
            'target',
            'countryDepartment',
            'targetCountryDepartment',
            'form'
        );


    }

    public function update (Request $request) {

    	
    	
    }
}
