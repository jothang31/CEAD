<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CeadCountryDepartment;

class CountryDepartmentController extends Controller
{

    public function get (Request $request) {

    }

    public function save (Request $request) {

    	$code = trim($request->code);
    	$name = trim($request->name);
    	$target = $request->dataTarget;
    	$form = $request->formId;

    	// Creamos el objeto que referencia a CEAD_COUNTRY_DEPARTMENTS;
    	$ceadCountryDepartment = new CeadCountryDepartment;

    	// Agregamos los datos;
    	$ceadCountryDepartment->CCD_CODE = $code;
    	$ceadCountryDepartment->CCD_NAME = $name;

    	// Guardamos
    	$ceadCountryDepartment->save();

    	// Regresamos los datos para actualizar en el select de municipios
    	return compact(
    		'code', 
    		'name', 
    		'target',
    		'form'
    	);

    }

    public function update (Request $request) {



    }
}
